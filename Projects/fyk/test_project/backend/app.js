require('dotenv').config();
const express = require('express');
const cors = require('cors');
const axios = require('axios');
const { default: FetchYourKeys } = require('fetchyourkeys');

const app = express();
const PORT = process.env.PORT || 3001;

// Vérification de la configuration
console.log('Configuration du serveur:');
console.log('- PORT:', PORT);

// Initialisation de FetchYourKeys
let GROQ_API_KEY = '';

async function loadKeys() {
    try {
        const fyk = new FetchYourKeys({
            apiKey: 'fk_93b97ee83b36847ee2030e15', // Clé API obligatoire
            environment: 'dev', // 'dev' (cache disque) ou 'prod' (cache mémoire)
            debug:false
            
        });

        const groqKey = await fyk.get('groqq');
        // Handle both possible response formats
        console.log(groqKey);
        
        GROQ_API_KEY = groqKey.data.value;
        if (GROQ_API_KEY) {
            console.log('- GROQ_API_KEY: *** (chargée depuis fetchyourkeys)');
        } else {
            throw new Error('Clé GROQ non trouvée dans la réponse');
        }
    } catch (error) {
        console.error('Erreur lors du chargement des clés avec fetchyourkeys:', error);
        }
}

// Chargement des clés au démarrage
loadKeys();

// Middleware
app.use(cors());
app.use(express.json());

// Middleware de logging des requêtes
app.use((req, res, next) => {
    console.log(`[${new Date().toISOString()}] ${req.method} ${req.url}`);
    next();
});

// Route de test
app.get('/api/test', (req, res) => {
    res.json({
        status: 'ok',
        timestamp: new Date().toISOString(),
        env: {
            node: process.version,
            port: PORT,
            groqKeyConfigured: !!process.env.GROQ_API_KEY
        }
    });
});

// Route pour le chat
app.post('/api/chat', async (req, res) => {
    // console.log('Requête reçue avec le body:', JSON.stringify(req.body, null, 2));
    
    if (!GROQ_API_KEY) {
        console.error('Erreur: GROQ_API_KEY non définie');
        return res.status(500).json({
            error: 'Configuration serveur incorrecte',
            details: 'La clé API Groq n\'est pas configurée correctement.'
        });
    }

    try {
        const { messages } = req.body;
        
        if (!messages || !Array.isArray(messages) || messages.length === 0) {
            return res.status(400).json({
                error: 'Requête invalide',
                details: 'Le champ messages est requis et doit être un tableau non vide.'
            });
        }

        console.log('Envoi de la requête à l\'API Groq...');
        const response = await axios.post(
            'https://api.groq.com/openai/v1/chat/completions',
            {
                model: 'llama-3.3-70b-versatile',
                messages,
                temperature: 0.7,
                max_tokens: 1024,
            },
            {
                headers: {
                    'Authorization': `Bearer ${GROQ_API_KEY}`,
                    'Content-Type': 'application/json',
                },
                timeout: 30000 // 30 secondes de timeout
            }
        );

        console.log('Réponse reçue de l\'API Groq');
        res.json(response.data);
    } catch (error) {
        console.error('Erreur lors de l\'appel à l\'API Groq:', error);
        
        let errorMessage = 'Une erreur est survenue lors de la communication avec le chatbot';
        let statusCode = 500;
        let errorDetails = error.message;
        
        if (error.response) {
            // La requête a été faite et le serveur a répondu avec un code d'erreur
            statusCode = error.response.status;
            errorDetails = {
                status: error.response.status,
                data: error.response.data,
                headers: error.response.headers
            };
            console.error('Détails de l\'erreur:', errorDetails);
        } else if (error.request) {
            // La requête a été faite mais aucune réponse n'a été reçue
            errorMessage = 'Aucune réponse reçue du serveur Groq';
            errorDetails = error.request;
            console.error('Aucune réponse reçue:', error.request);
        }
        
        res.status(statusCode).json({ 
            error: errorMessage,
            details: errorDetails
        });
    }
});

// Gestion des erreurs globales
process.on('unhandledRejection', (reason, promise) => {
    console.error('Unhandled Rejection at:', promise, 'reason:', reason);n});

// Démarrer le serveur
app.listen(PORT, () => {
    console.log(`\n=== Serveur démarré sur http://localhost:${PORT} ===\n`);
});