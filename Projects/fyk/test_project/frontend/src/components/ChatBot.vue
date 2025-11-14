<template>
  <div class="chat-container">
    <div class="chat-messages" ref="messagesContainer">
      <div 
        v-for="(message, index) in messages" 
        :key="index"
        :class="['message', message.role]">
        <div class="message-content">
          {{ message.content }}
        </div>
      </div>
      <div v-if="isLoading" class="message assistant">
        <div class="message-content typing">
          <span></span><span></span><span></span>
        </div>
      </div>
    </div>
    <div class="chat-input">
      <input
        v-model="userInput"
        @keyup.enter="sendMessage"
        placeholder="Tapez votre message..."
        :disabled="isLoading"
      />
      <button @click="sendMessage" :disabled="!userInput.trim() || isLoading">
        Envoyer
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue';
import axios from 'axios';

const messages = ref([
  {
    role: 'assistant',
    content: 'Bonjour ! Je suis votre assistant IA. Comment puis-je vous aider aujourd\'hui ?'
  }
]);

const userInput = ref('');
const isLoading = ref(false);
const messagesContainer = ref(null);

const scrollToBottom = () => {
  nextTick(() => {
    if (messagesContainer.value) {
      messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight;
    }
  });
};

const sendMessage = async () => {
  const message = userInput.value.trim();
  if (!message || isLoading.value) return;

  // Ajouter le message de l'utilisateur
  messages.value.push({
    role: 'user',
    content: message
  });
  
  userInput.value = '';
  isLoading.value = true;
  scrollToBottom();

  try {
    const response = await axios.post('http://localhost:3001/api/chat', {
      messages: messages.value.map(m => ({
        role: m.role,
        content: m.content
      }))
    });

    // Ajouter la réponse de l'IA
    const aiResponse = response.data.choices[0].message;
    messages.value.push({
      role: 'assistant',
      content: aiResponse.content
    });
  } catch (error) {
    console.error('Erreur lors de l\'envoi du message:', error);
    messages.value.push({
      role: 'assistant',
      content: 'Désolé, une erreur est survenue. Veuillez réessayer plus tard.'
    });
  } finally {
    isLoading.value = false;
    scrollToBottom();
  }
};

onMounted(() => {
  scrollToBottom();
});
</script>

<style scoped>
.chat-container {
  display: flex;
  flex-direction: column;
  max-width: 800px;
  margin: 0 auto;
  height: 80vh;
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.chat-messages {
  flex: 1;
  padding: 20px;
  overflow-y: auto;
  background-color: #f9f9f9;
}

.message {
  margin-bottom: 16px;
  max-width: 80%;
  word-wrap: break-word;
}

.message.user {
  margin-left: auto;
  text-align: right;
}

.message.assistant {
  margin-right: auto;
  text-align: left;
}

.message-content {
  display: inline-block;
  padding: 10px 16px;
  border-radius: 18px;
  line-height: 1.4;
}

.user .message-content {
  background-color: #007bff;
  color: white;
  border-bottom-right-radius: 4px;
}

.assistant .message-content {
  background-color: #f1f1f1;
  color: #333;
  border-bottom-left-radius: 4px;
}

.typing span {
  display: inline-block;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background-color: #888;
  margin: 0 2px;
  animation: bounce 1.4s infinite ease-in-out;
}

.typing span:nth-child(1) {
  animation-delay: 0s;
}

.typing span:nth-child(2) {
  animation-delay: 0.2s;
}

.typing span:nth-child(3) {
  animation-delay: 0.4s;
}

@keyframes bounce {
  0%, 60%, 100% {
    transform: translateY(0);
  }
  30% {
    transform: translateY(-5px);
  }
}

.chat-input {
  display: flex;
  padding: 16px;
  background-color: white;
  border-top: 1px solid #e0e0e0;
}

.chat-input input {
  flex: 1;
  padding: 10px 16px;
  border: 1px solid #ddd;
  border-radius: 20px;
  outline: none;
  font-size: 14px;
  transition: border-color 0.3s;
}

.chat-input input:focus {
  border-color: #007bff;
}

.chat-input button {
  margin-left: 10px;
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 20px;
  cursor: pointer;
  font-size: 14px;
  transition: background-color 0.3s;
}

.chat-input button:hover {
  background-color: #0056b3;
}

.chat-input button:disabled {
  background-color: #cccccc;
  cursor: not-allowed;
}
</style>
