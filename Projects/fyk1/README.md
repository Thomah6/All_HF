# Projet FetchYourKeys : gestion sécurisée des clés API via Google Drive

## Objectif du projet

FetchYourKeys permet aux utilisateurs de stocker, gérer et accéder en toute sécurité à leurs clés API via leur propre compte Google Drive. L’application garantit que les clés sensibles ne sont jamais exposées en clair côté serveur, assurant confiance, confidentialité et simplicité d’usage.

## Fonctionnement détaillé

1.  **Connexion utilisateur & autorisation Google Drive**
    *   L’utilisateur crée un compte sur FetchYourKeys.
    *   Il se connecte à Google Drive via OAuth2 et donne une autorisation précise d’accès à un dossier dédié dans son Google Drive (scope limité).
    *   Cette autorisation est conservée côté client/serveur pour synchroniser les clés.

2.  **Ajout et stockage sécurisé des clés**
    *   Depuis le frontend, l’utilisateur ajoute ses clés API (ou autres secrets numériques).
    *   Chaque clé est chiffrée localement dans le navigateur avec une phrase secrète/mot de passe que seul l’utilisateur connaît (via WebCrypto API).
    *   Le fichier JSON contenant la clé chiffrée est uploadé dans le dossier Google Drive autorisé.
    *   Aucune clé en clair ne transite ni n’est stockée sur le serveur FetchYourKeys.

3.  **Accès aux clés via l’API FetchYourKeys**
    *   FetchYourKeys fournit une API sécurisée pour récupérer les clés.
    *   L’API utilise l’accès OAuth afin de lire les fichiers chiffrés dans Google Drive.
    *   L’utilisateur reçoit un fichier .env personnalisé avec les variables d’environnement nécessaires (adresse API, tokens, variables spécifiques).
    *   Pour faciliter l’intégration, FetchYourKeys génère aussi des snippets de code à copier-coller, adaptés à l’environnement de déploiement (Node.js, Python, etc.) permettant de récupérer et déchiffrer les clés localement.

4.  **Visualisation, modification et suppression de clés**
    *   L’interface web permet à l’utilisateur de visualiser la liste des clés chiffrées synchronisées depuis Google Drive.
    *   Il peut modifier, supprimer ou ajouter des clés, avec chiffrement/déchiffrement automatic côté client et synchronisation immédiate.
    *   L’historique des modifications est disponible pour audit.

5.  **Sécurité & gestion de la confiance**
    *   L’utilisateur reste propriétaire exclusif de ses clés : chiffrement fait localement, stockage sur Google Drive personnel.
    *   Le système ne connaît jamais la phrase secrète ni les clés en clair.
    *   Authentification forte (2FA) sur FetchYourKeys, notifications d’accès, révoquabilité des accès OAuth.
    *   Code source open source pour transparence, audits réguliers et bug bounty.

## Interfaces nécessaires

*   **A. Interface d’authentification & gestion du compte**
    *   Formulaire de connexion Inscription.
    *   Gestion du lien Google Drive avec OAuth, affichage du statut d’autorisation.
    *   Paramètres de sécurité utilisateur (mot de passe, 2FA, notifications).

*   **B. Dashboard principal de gestion des clés**
    *   Liste paginée des clés stockées (métadonnées : nom, date création/modif, type).
    *   Vue détaillée par clé (affiche métadonnées, historique, options).
    *   Actions : ajouter, modifier (chiffrement local), supprimer clés.
    *   Synchronisation automatique avec Google Drive.

*   **C. Interface de génération & téléchargement des outils d’intégration**
    *   Génération et export du fichier .env personnalisé.
    *   Vue / export des snippets de code prêts à copier-coller pour récupérer les clés via l’API.
    *   Documentation intégrée, guides d’utilisation.

*   **D. Interface d’administration & audit**
    *   Logs d’accès aux clés, alertes de sécurité, synopsis d’activité.
    *   Gestion des accès OAuth, révocation manuelle des autorisations Google Drive.

## Technologies recommandées

*   **Frontend**: Vue.js + Tailwind (réactif et fluide).
*   **Backend**: Node.js/Express, orchestrant appels API Google Drive via OAuth.
*   **Cryptographie**: WebCrypto API (client).
*   **Stockage**: Google Drive (fichiers JSON chiffrés).
*   **Authentification**: OAuth2 (Google + 2FA maison).
*   **Documentation & snippets**: générés dynamiquement selon configuration utilisateur.

## Résumé

fetchyourkeys est une solution complète et sécurisée de gestion de clés qui mise sur :

*   Confidentialité totale via chiffrement local et stockage personnel cloud.
*   Simplicité utilisateur grâce à une UI claire et des outils d’intégration simples.
*   Confiance renforcée par transparence, contrôle et sécurité avancée.
*   Flexibilité d’intégration avec des fichiers .env et snippets adaptés à tous environnements.
