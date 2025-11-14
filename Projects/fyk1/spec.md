# Spécifications du projet FetchYourKeys

je decide donc une appli qui est comme une boite où tu enferme toutes tes clés(nom, services,description, value) bien securisé. en retour cette appli te donne un script de fetch avec un token API unique d'acces. grace  a ce fetch, tu pourra recuperer a partir de tes projets local ou en prod, un key precis dejà enregistré auparavant dans la boite.la reponse sera donc un json MEradonées(nom,service,value)

## Vue d'ensemble
Application web pour gérer et sécuriser les clés API avec une API REST sécurisée. L'application utilise Vue 3 avec Composition API et Supabase pour l'authentification et la base de données.


Dans notre application où un clé unique serait généré pour accéder à la "boîte" de clés API, la terminologie habituelle serait d'appeler Ainsi, dans votre système :

API Key (ou Primary API Key) : clé unique permanente que l'utilisateur possède pour interroger votre service.

Stocked API Keys : clés qu'il stocke dans la boîte, spécifiques à chaque service ou projet externe.

## Authentification
- Authentification utilisateur avec Supabase (google & github)
- Gestion des sessions sécurisées avec rafraîchissement automatique des tokens
- Protection des routes nécessitant une authentification
- Vérification des rôles utilisateurs pour l'accès administrateur
- Affichage sécurisé des informations utilisateur (email tronqué dans l'interface)
- Gestion des erreurs d'authentification avec messages utilisateur clairs

## Fonctionnalités principales

### 1. Système d'authentification
- Inscription et connexion utilisateur
- Déconnexion sécurisée
- Protection des routes avec gardes de navigation
- Gestion des profils utilisateurs avec :
  - Nom d'utilisateur
  - Primary api key (autogeneré un initial, l'utilisateur peut en creer d'autre et aussi desactiver )
  - Nom complet
  - Photo de profil
  - Numéro de téléphone
  - Date de mise à jour
- Mise à jour des informations de profil
- Téléchargement d'avatar avec stockage sécurisé

### 2. Gestion des clés API stocked
- Création, lecture, suppression de clés
- Chaque clé a un nom unique (insensible à la casse, 6-64 caractères, a-z0-9_-)
- Champs par clé :
  - `name` (unique, requis)
  - `value` (8-1024 caractères, chiffrée)
  - `service` (référence au catalogue de services)
  - `environment` (dev/staging/prod, défaut: dev)
  - `status` (active/inactive, défaut: active)
  - `description` (optionnel)
  - `expires_at` (optionnel, désactive la clé si dépassé)
  - `created_by` (auteur)
  - `created_at`
  - `last_used_at`
- Système de tags globaux pour catégorisation

### 3. Catalogue de services
- Liste partagée de services (nom, URL, logo)
- Possibilité d'ajouter des services personnalisés

### 4. API REST
- Authentification par Bearer token (le primary api key)
- Endpoints :
  - `GET /v1/keys` - Lister les clés (sans valeurs)
  - `GET /v1/keys/:name` - Récupérer une clé (avec valeur si active)

### 5. Sécurité
- Protection des routes sensibles avec authentification
- Sécurité au niveau des lignes (RLS) pour l'accès aux données
- Chiffrement des données sensibles
- Validation des entrées utilisateur
- Protection contre les attaques CSRF et XSS
- Gestion sécurisée des tokens d'authentification
- Politiques de sécurité strictes pour l'accès à la base de données
- Vérification des rôles utilisateurs
- Gestion des erreurs d'authentification
- Redirection sécurisée après authentification
- Chiffrement des valeurs sensibles
- Rate limiting: 60 req/min par token
- Pas de CORS (API server-only)
- Logs d'accès pour le suivi

### 6. Interface utilisateur
- Design moderne et réactif avec Tailwind CSS
- Navigation intuitive avec barre latérale et en-tête
- Affichage adaptatif pour mobile et desktop
- Notifications utilisateur pour les actions importantes
- États de chargement et retours visuels
- Menu utilisateur déroulant avec accès rapide au profil et à la déconnexion
- Affichage sécurisé des informations sensibles (emails tronqués, etc.)



## Modèle de données

### Tables principales
- `users` - Comptes utilisateurs
- `primary_keys` - primarys keys des users
- `services` - Catalogue des services
- `tags` - Tags auxquels attacher les clés
- `keys` - Clés API

## Workflow d'intégration
Voici un workflow idéal pour votre application de gestion sécurisée des clés API avec une clé d’accès unique fixe et la récupération sécurisée des clés stockées :

## Workflow idéal

1. **Inscription de l’utilisateur**
   - L’utilisateur s’inscrit sur la plateforme.
   - Une **Primary API Key** (clé API principale unique et fixe) est automatiquement générée et attribuée à l’utilisateur.
   - Cette clé est affichée une première fois et conservée de manière sécurisée.

2. **Ajout/Rangement des clés dans la boîte**
   - L’utilisateur connecte son compte ou projet.
   - Il ajoute des **API Keys** spécifiques aux services externes dont il veut gérer les accès (nom, service, description, valeur).
   - Ces clés sont stockées chiffrées dans la “boîte” sécurisée.

3. **Accès à la clé via script fetch**
   - L’utilisateur intègre dans ses projets (local ou prod) un script fetch.
   - Ce script utilise la **Primary API Key** dans l’en-tête Authorization (ex : Bearer token ou clé API standard).
   - Le script interroge l’API de la boîte pour récupérer une clé précise à partir du nom ou service.

4. **Réponse de l’API**
   - L’API valide la clé d’accès principale.
   - Si valide, elle renvoie un JSON contenant la clé stockée demandée (nom, service, valeur).
   - Sinon, la requête est rejetée (erreur 401 ou 403).

5. **Gestion des clés d’accès**
   - L’utilisateur peut générer manuellement d’autres clés d’accès secondaires (API Keys secondaires) pour différentes applications ou équipes.
   - Il peut révoquer, renouveler ou restreindre les permissions de ces clés.

6. **Sécurité et rotation**
   - La Primary API Key peut être renouvelée manuellement par l’utilisateur.
   - Les clés stockées dans la boîte sont régulièrement auditées, et les clés obsolètes peuvent être supprimées.
   - Toutes les communications sont protégées par HTTPS et clés chiffrées au repos.

## Avantages

- Centralisation et sécurisation de toutes les clés dans une seule boîte.
- Accès simple et standardisé via une clé principale.
- Flexibilité avec gestion multi-clés secondaires.
- Réduction des risques d’exposition accidentelle.
- Facilitation du processus d’intégration dans les projets.

Ce workflow allie simplicité d’usage, sécurité renforcée et bonne organisation des clés API pour les développeurs.[1][2][3][4]


## Routes principales
- `/login` - Page de connexion
- `/register` - Page d'inscription
- `/dash` - Page de dashboard
- `/keys` - Gestion des clés
- `/logs` - Logs d'activité
- `/keys/create` - Création d'une clé
- `/keys/update` - Mise à jour d'une clé
- `/keys/delete` - Suppression d'une clé
- `/keys/rotate` - Rotation d'une clé
- `/keys/audit` - Audition des clés
- `/keys/search` - Recherche de clé
- `/profile` - Profil utilisateur
- `/settings` - Paramètres du compte


## Architecture technique
- **Frontend**: Vue 3 avec Composition API et Vue Router
- **Backend**: Supabase (Auth, Database, Storage)
- **Base de données**: PostgreSQL avec RLS (Row Level Security)
- **Stockage**: Supabase Storage pour les fichiers utilisateur
- **UI/UX**: Tailwind CSS pour le style
- **Outils de développement**: Vite, ESLint, Prettier