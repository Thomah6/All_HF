Quelles sections livrer en premier côté UI:Auth, Dashboard, Keys (list + create + view), Profile, 

Le playground API (fetch avec Primary API Key) fait-il partie du MVP ou en 2e phase ?: NON pas de playground dans le mvp

As-tu déjà un projet Supabase créé (URL/anon/service keys) ? Comptes-tu me les fournir via .env ? :oui j'ai des données du projet supabase

providers d’auth actifs: Google et GitHub uniquement ?: oui

Souhaites-tu qu’on stocke avatars dans Supabase Storage dès le MVP ?: 

Confirme la structure des tables: users, primary_keys, services, tags, keys. Des champs à ajouter/retirer ? :ajoutons logs

Les primary_keys: une clé auto-générée à l’inscription + possibilité d’en créer/désactiver d’autres. OK ?: oui 

keys.name: unique par utilisateur, insensible à la casse. On normalise en minuscule côté DB ?: oui

keys.value: chiffrée côté client (E2E) ou côté serveur (Edge Function) ? Préférence ?: fait comme ca doit pour etre bon et simple

environment valeurs exactes: dev, staging, prod ? par défaut dev ?:oui


service: référence obligatoire à services ou texte libre autorisé ? texte libre autorisé et img par defaut comme logo

tags: système libre par user, liaison many‑to‑many ?systeme libre


Tu veux un vrai E2E (clé dérivée d’un secret utilisateur jamais envoyé) ou chiffrement côté serveur (Edge Function) avec rotation de clés KMS-like ?: le plus simple pour le mvp


Algorithme: AES‑256‑GCM confirmé. Où est stockée la master key (ou dérivation) ? la master key c'est ca j'ai encore appelé primary API key


RLS: accès strict par user_id sur toutes les tables liées. OK de base ? ok


Rotation/révocation des primary_keys: MVP ou phase 2 ? MVP


Hébergement de l’API: Supabase Edge Functions uniquement ? Ou autre (Cloudflare/Vercel Functions) ?le plus simple et fonctionnel possible


Domaine d’API prévu (ex: api.fetchyourkeys.com) ou on reste sur URL Supabase pour MVP ? j'ai pas prevu encore, je compte sur la gratuité de vercel


Rate limiting: 60 req/min par token — on l’implémente via Edge Runtime KV/Redis/Db counters ? Préférence ? le plus simple


CORS: tu indiques “Pas de CORS (API server-only)”. On bloque tout sauf les serveurs ? Pour le MVP, on accepte localhost pour tests ? accepter localhost pour tests


Format d’erreurs standardisé (ex: { error: { code, message } }) — des codes spécifiques à prévoir ? oui que ce soit 


GET /v1/keys: renvoie liste sans value. Champs: name, service, environment, status, tags, last_used_at ?
GET /v1/keys/:name: renvoie name, service, value, environment, status si active. On masque value côté UI sauf “copy to clipboard” ?oui

UI/UX
Design system: Tailwind pur + composants simples, ou veux-tu intégrer une lib (Headless UI, Radix Vue) ? daisyUI

Langue: FR seule au début ? Besoin i18n plus tard ? anglais seul

Email tronqué: format souhaité (ex: her***@gmail.com) ? : non herms...


Logs et Audit
Quels événements loguer dès le MVP: connexion, ajout/suppression clé, lecture clé via API ? juste  lecture clé via API avec code resultats des requetes


Stockage des logs: table logs en DB. Rétention souhaitée ?
Affichage LogsView: filtre par date, action, clé — MVP ou plus simple ?oui

Catalogue de services
Démarrage avec une liste seed (OpenAI, Stripe, GCP, AWS, GitHub) ? Tu veux pouvoir ajouter custom services dès le MVP ?oui

Environnements: dev (local), staging, prod. On cible d’abord dev/prod ?oui

Front sur Vercel confirmé. Nom de projet/domaine prévu ? ca sera peut etre fetchyourkeys.vercel.app

Variables d’env: je crée .env.example avec clés Supabase, flags de chiffrement, etc. OK ? oui

Tu souhaites des tests e2e (Playwright) ou unitaires minimum pour Edge Functions ?pas si on peux s'en passer 


ESLint/Prettier déjà en place — règles spécifiques à respecter ?deja


Performance/Coûts
Pagination pour GET /v1/keys (ex: limit/offset 20 par défaut) ?oui


Soft delete pour clés/logs ou hard delete direct ?j'ai pas compris cette question


Roadmap risques
Si E2E est prioritaire, il impacte fortement UX (perte du secret = perte d’accès). Accepté ? Prévoir mécanisme de recovery ?mecanisme de recovery