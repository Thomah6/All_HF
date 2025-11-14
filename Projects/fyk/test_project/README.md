# Chatbot IA avec Vue.js, Express et Groq

Ce projet est une application de chat utilisant Vue.js pour le frontend, Express pour le backend, et l'API Groq pour les réponses IA avec le modèle LLaMA 3.3 70B.

## Prérequis

- Node.js (version 16 ou supérieure)
- npm (gestionnaire de paquets Node.js)
- Une clé API Groq (obtenue sur [Groq Cloud](https://console.groq.com/))

## Installation

1. **Configurer le backend**
   ```bash
   cd backend
   cp .env.example .env
   ```
   
   Modifiez le fichier `.env` pour ajouter votre clé API Groq :
   ```
   GROQ_API_KEY=votre_clé_api_groq_ici
   ```

2. **Installer les dépendances du backend**
   ```bash
   cd backend
   npm install
   ```

3. **Installer les dépendances du frontend**
   ```bash
   cd ../frontend
   npm install
   ```

## Lancement de l'application

1. **Démarrer le serveur backend**
   ```bash
   cd backend
   npm start
   ```
   Le serveur démarrera sur http://localhost:3001

2. **Démarrer l'application frontend**
   Dans un autre terminal :
   ```bash
   cd frontend
   npm run dev
   ```
   L'application sera disponible sur http://localhost:5173

## Utilisation

1. Ouvrez votre navigateur et accédez à http://localhost:5173
2. Commencez à discuter avec le chatbot dans l'interface
3. Le chatbot répondra en utilisant l'API Groq avec le modèle LLaMA 3.3 70B

## Structure du projet

- `/backend` : Serveur Express qui gère les appels à l'API Groq
  - `app.js` : Configuration du serveur et des routes
  - `.env` : Fichier de configuration des variables d'environnement

- `/frontend` : Application Vue.js
  - `src/components/ChatBot.vue` : Composant principal du chat
  - `src/views/HomeView.vue` : Page d'accueil avec le chat

## Configuration

Vous pouvez modifier les paramètres du modèle dans `backend/app.js` :
- `temperature` : Contrôle le caractère aléatoire des réponses (entre 0 et 1)
- `max_tokens` : Nombre maximum de tokens dans la réponse
