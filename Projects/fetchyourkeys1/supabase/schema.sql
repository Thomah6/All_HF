-- FetchYourKeys - Schéma MVP
-- À exécuter dans le SQL Editor de Supabase

-- 1) Extensions nécessaires
create extension if not exists pgcrypto;

-- 2) Tables

-- Profil minimal par utilisateur (lié à auth.users)
create table if not exists public.profiles (
  id uuid primary key references auth.users(id) on delete cascade,
  full_name text,
  avatar_url text,
  phone text,
  updated_at timestamptz default now(),
  created_at timestamptz default now()
);

-- Primary API Keys de l'utilisateur
create table if not exists public.primary_keys (
  id uuid primary key default gen_random_uuid(),
  user_id uuid not null references auth.users(id) on delete cascade,
  name text not null default 'primary',
  token_hash text not null,
  status text not null default 'active' check (status in ('active','inactive')),
  created_at timestamptz not null default now(),
  last_used_at timestamptz
);

create unique index if not exists uq_primary_keys_user_name on public.primary_keys(user_id, name);
create index if not exists idx_primary_keys_user_status on public.primary_keys(user_id, status);

-- Stocked API keys (chiffrées côté serveur via Edge Function)
create table if not exists public.keys (
  id uuid primary key default gen_random_uuid(),
  user_id uuid not null references auth.users(id) on delete cascade,
  name text not null,
  name_normalized text generated always as (lower(name)) stored,
  value_encrypted text not null,
  encryption_meta jsonb not null default '{}'::jsonb,
  service text,
  environment text not null default 'dev' check (environment in ('dev','staging','prod')),
  status text not null default 'active' check (status in ('active','inactive')),
  description text,
  expires_at timestamptz,
  created_at timestamptz not null default now(),
  last_used_at timestamptz
);

create unique index if not exists uq_keys_user_name_norm on public.keys(user_id, name_normalized);
create index if not exists idx_keys_user_env on public.keys(user_id, environment);
create index if not exists idx_keys_user_status on public.keys(user_id, status);

-- Logs d'accès (lecture via API)
create table if not exists public.logs (
  id uuid primary key default gen_random_uuid(),
  user_id uuid not null references auth.users(id) on delete cascade,
  primary_key_id uuid references public.primary_keys(id) on delete set null,
  key_name text,
  result_code int, -- 200, 401, 403, 404, 429, etc.
  source text,     -- optionnel: ip/app/env
  created_at timestamptz not null default now(),
  details jsonb default '{}'::jsonb
);

create index if not exists idx_logs_user_created_at on public.logs(user_id, created_at desc);

-- One-time storage pour livrer la Primary API Key en clair une seule fois
create table if not exists public.primary_key_otps (
  user_id uuid primary key references auth.users(id) on delete cascade,
  token_plain text not null,
  created_at timestamptz not null default now(),
  expires_at timestamptz not null default (now() + interval '15 minutes'),
  claimed_at timestamptz
);


-- 3) RLS (Row Level Security)
alter table public.profiles enable row level security;
alter table public.primary_keys enable row level security;
alter table public.keys enable row level security;
alter table public.logs enable row level security;
alter table public.primary_key_otps enable row level security;

-- Profiles: l'utilisateur accède uniquement à son profil
drop policy if exists profiles_select_own on public.profiles;
create policy profiles_select_own on public.profiles
  for select
  using (id = auth.uid());
drop policy if exists profiles_update_own on public.profiles;
create policy profiles_update_own on public.profiles
  for update
  using (id = auth.uid());

-- Primary keys: lecture par le propriétaire (hash non sensible), updates contrôlés plus tard via RPC
drop policy if exists primary_keys_select_own on public.primary_keys;
create policy primary_keys_select_own on public.primary_keys
  for select
  using (user_id = auth.uid());

-- Keys: CRUD limité à l'utilisateur
drop policy if exists keys_select_own on public.keys;
create policy keys_select_own on public.keys
  for select
  using (user_id = auth.uid());
drop policy if exists keys_insert_own on public.keys;
create policy keys_insert_own on public.keys
  for insert
  with check (user_id = auth.uid());
drop policy if exists keys_update_own on public.keys;
create policy keys_update_own on public.keys
  for update
  using (user_id = auth.uid());
drop policy if exists keys_delete_own on public.keys;
create policy keys_delete_own on public.keys
  for delete
  using (user_id = auth.uid());

-- Logs: l'utilisateur peut voir ses logs; insertion se fera via Service Role (bypass RLS)
drop policy if exists logs_select_own on public.logs;
create policy logs_select_own on public.logs
  for select
  using (user_id = auth.uid());

-- OTPs: aucune lecture directe; la récupération passe par une RPC SECURITY DEFINER
-- (pas de policy SELECT). On ajoute une policy UPDATE/DELETE si nécessaire pour la RPC,
-- mais SECURITY DEFINER l'ignorera si le propriétaire est postgres.


-- 4) Fonction et Trigger d'inscription

-- Crée un profil et une Primary API Key (hashée) + enregistre un OTP one-time (plaintext)
create or replace function public.handle_new_user()
returns trigger
language plpgsql
security definer
set search_path = public
as $$
declare
  v_token text;
begin
  -- Créer le profil minimal
  insert into public.profiles(id)
  values (new.id)
  on conflict (id) do nothing;

  -- Générer une Primary API Key en clair (ex: fy_<hex>)
  v_token := 'fy_' || encode(gen_random_bytes(24), 'hex');

  -- Stocker seulement le hash en base
  insert into public.primary_keys(user_id, name, token_hash)
  values (new.id, 'primary', crypt(v_token, gen_salt('bf')))
  on conflict (user_id, name) do nothing;

  -- Mettre à disposition le token en clair une seule fois (15 min)
  insert into public.primary_key_otps(user_id, token_plain)
  values (new.id, v_token)
  on conflict (user_id) do update set
    token_plain = excluded.token_plain,
    created_at = now(),
    expires_at = now() + interval '15 minutes',
    claimed_at = null;

  return new;
end;
$$;

-- Attacher le trigger sur auth.users (création de compte OAuth)
-- Désactivé pour éviter de bloquer l'inscription en cas d'erreur. On utilise une RPC init_user() post-login.
drop trigger if exists on_auth_user_created on auth.users;
-- create trigger on_auth_user_created
--   after insert on auth.users
--   for each row execute function public.handle_new_user();


-- 5) RPC: récupérer la Primary API Key une seule fois après login
create or replace function public.claim_initial_primary_key()
returns text
language plpgsql
security definer
set search_path = public
as $$
declare
  v_token text;
begin
  -- Marque comme réclamé et retourne le token si non expiré
  update public.primary_key_otps
    set claimed_at = now()
  where user_id = auth.uid()
    and claimed_at is null
    and expires_at > now()
  returning token_plain into v_token;

  return v_token; -- peut être null si déjà réclamé/expiré
end;
$;

-- 5b) RPC: initialisation post-login (idempotente)
create or replace function public.init_user()
returns void
language plpgsql
security definer
set search_path = public
as $
declare
  v_exists boolean;
  v_token text;
begin
  -- S'assurer que le profil existe
  insert into public.profiles(id)
  values (auth.uid())
  on conflict (id) do nothing;

  -- S'assurer qu'une Primary API Key existe
  select exists (
    select 1 from public.primary_keys where user_id = auth.uid() and name = 'primary'
  ) into v_exists;

  if not v_exists then
    v_token := 'fy_' || encode(gen_random_bytes(24), 'hex');

    insert into public.primary_keys(user_id, name, token_hash)
    values (auth.uid(), 'primary', crypt(v_token, gen_salt('bf')));

    insert into public.primary_key_otps(user_id, token_plain)
    values (auth.uid(), v_token)
    on conflict (user_id) do update set
      token_plain = excluded.token_plain,
      created_at = now(),
      expires_at = now() + interval '15 minutes',
      claimed_at = null;
  end if;
end;
$;

-- 6) Aides: vérifications de hash en SQL (si besoin via RPC plus tard)
-- create or replace function public.verify_primary_key(p_user_id uuid, p_token text)
-- returns boolean language sql security definer set search_path = public as $$
--   select exists (
--     select 1 from public.primary_keys
--     where user_id = p_user_id and status = 'active'
--       and token_hash = crypt(p_token, token_hash)
--   );
-- $$;

-- 7) RPCs gestion des Primary API Keys (génération/activation/suppression)
create or replace function public.generate_primary_key(p_name text default null)
returns text
language plpgsql
security definer
set search_path = public
as $
declare
  v_name text := coalesce(p_name, 'key_' || to_char(now(), 'YYYYMMDDHH24MISS'));
  v_exists boolean;
  v_try int := 0;
  v_token text;
begin
  -- Garantir l'unicité du nom pour cet utilisateur
  loop
    select exists (
      select 1 from public.primary_keys where user_id = auth.uid() and name = v_name
    ) into v_exists;
    exit when not v_exists;
    v_try := v_try + 1;
    v_name := v_name || '_' || lpad(v_try::text, 2, '0');
  end loop;

  -- Générer le token et stocker son hash
  v_token := 'fy_' || encode(gen_random_bytes(24), 'hex');
  insert into public.primary_keys(user_id, name, token_hash)
  values (auth.uid(), v_name, crypt(v_token, gen_salt('bf')));

  return v_token; -- Le client doit l'afficher/copier immédiatement
end;
$;

create or replace function public.set_primary_key_status(p_id uuid, p_status text)
returns void
language plpgsql
security definer
set search_path = public
as $
begin
  if p_status not in ('active','inactive') then
    raise exception 'invalid status';
  end if;
  update public.primary_keys
    set status = p_status
  where id = p_id
    and user_id = auth.uid();
end;
$;

create or replace function public.delete_primary_key(p_id uuid)
returns void
language plpgsql
security definer
set search_path = public
as $
begin
  delete from public.primary_keys
  where id = p_id
    and user_id = auth.uid();
end;
$;

-- Notes:
-- - Les insertions de logs et la lecture d'une key par API seront faites via Edge Functions
--   avec la Service Role Key (bypass RLS). La validation du token se fera côté Edge (bcrypt compare).
-- - value_encrypted est chiffrée côté Edge Function (AES-256-GCM). encryption_meta stocke le nonce, tag, etc.
-- - Pour éviter l'erreur d'inscription, assure-toi que ce trigger est bien en place et que
--   aucun autre trigger existant ne provoque d'exception (colonne NOT NULL, etc.).
