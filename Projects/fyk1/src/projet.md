# FetchYourKeys - Gestion Sécurisée des Clés API


## 📋 Table des Matières

- [Introduction](#-introduction)
- [Fonctionnalités](#-fonctionnalités)
- [Architecture](#-architecture)
- [Installation](#-installation)
- [Utilisation](#-utilisation)
- [Sécurité](#-sécurité)
- [API Reference](#-api-reference)
- [Contribution](#-contribution)
- [License](#-license)

## 🚀 Introduction

**FetchYourKeys** est une application web innovante conçue pour résoudre le problème de gestion des clés API. Elle permet aux développeurs de stocker, organiser et accéder à leurs clés API de manière sécurisée depuis n'importe quel appareil.

### Le Problème

Les développeurs doivent souvent gérer des dizaines de clés API pour différents services. Ces clés sont généralement:
- Éparpillées dans différents projets
- Stockées en clair dans des variables d'environnement
- Difficiles à retrouver et à mettre à jour
- À risque en cas de fuite ou de compromission

### La Solution

FetchYourKeys offre:
- Un stockage centralisé et chiffré de toutes vos clés API
- Un accès sécurisé via une unique clé maître
- Une interface intuitive pour gérer et organiser vos clés
- Un playground pour tester vos APIs facilement

## ✨ Fonctionnalités

### 🔐 Gestion Sécurisée des Clés
- Chiffrement de bout en bout des clés API
- Stockage sécurisé avec Supabase
- Contrôle d'accès granulaire

### 🌐 Accessibilité Universelle
- Accès à vos clés depuis n'importe quel appareil
- Interface responsive adaptée à tous les écrans
- Synchronisation en temps réel
<!--  -->

### 🔌 Intégration Simplifiée
- API unique pour accéder à toutes vos clés
- Exemples de code pour plusieurs langages (cURL, JavaScript, Node.js, Python, etc.)
- Documentation complète et détaillée

## 🏗 Architecture

### Stack Technique
- **Frontend**: vuejs, Tailwind CSS
- **Backend**: Supabase (Base de données, Authentification, Edge Functions)
- **Stockage**: PostgreSQL avec chiffrement au repos
- **Déploiement**: Vercel (frontend), Supabase (backend)




## 📖 Utilisation

### Ajouter une Clé API

1. Connectez-vous à votre compte FetchYourKeys
2. Cliquez sur "API Keys" dans la sidebar
3. Sélectionnez "Add Key"
4. Remplissez les informations:
   - Nom de la clé
   - Valeur de la clé
   - Service (OpenAI, Stripe, Google Cloud, etc.)
   - Description (optionnel)
   - Tags (optionnel)

5. La clé est automatiquement chiffrée et stockée de manière sécurisée

### Récupérer une Clé API

Via l'interface:
1. Naviguez vers la section "API Keys"
2. Trouvez la clé souhaitée
3. Copiez la valeur (déchiffrée temporairement pour l'affichage)

Via l'API:
```bash
curl -X GET "https://api.fetchyourkeys.com/v1/keys/:name" \
  -H "Authorization: Bearer VOTRE_CLE_PRIMARY"
```

### Utiliser dans un Projet

```javascript
// Exemple avec fetch
const response = await fetch('https://api.fetchyourkeys.com/v1/keys/OPENAI_API_KEY', {
  headers: {
    'Authorization': 'Bearer VOTRE_CLE_PRIMARY'
  }
});
const data = await response.json();
const openAIApiKey = data.value;

/
```

## 🔒 Sécurité

### Chiffrement
- Toutes les clés API sont chiffrées avec AES-256-GCM


### Bonnes Pratiques Implémentées
- Authentification forte avec Supabase Auth
- Journalisation des accès et des utilisations de clés

- Pas de stockage en clair des clés sensibles

### Mesures de Protection
- Limitation du taux d'appels API
- Validation des entrées utilisateur
- Prévention des attaques par injection
- Cookies sécurisés et HTTPOnly

## 📚 API Reference

### Endpoints Principaux

#### Récupérer une clé
```
GET /v1/keys/:name
Headers: 
  Authorization: Bearer <primary_key>
```

#### Lister toutes les clés
```
GET /v1/keys
Headers: 
  Authorization: Bearer <primary_key>
```

**FetchYourKeys** - Ne perdez plus jamais vos clés API! 🔑



