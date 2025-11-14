<script setup>
import ChatBot from '@/components/ChatBot.vue';
</script>

<template>
  <div class="home">
    <h1>Chatbot IA avec Groq</h1>
    <div class="chat-wrapper">
      <ChatBot />
    </div>
  </div>
</template>

<style scoped>
.home {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

h1 {
  text-align: center;
  color: #2c3e50;
  margin-bottom: 2rem;
}

.chat-wrapper {
  max-width: 800px;
  margin: 0 auto;
  height: calc(100vh - 150px);
}

@media (max-width: 768px) {
  .chat-wrapper {
    height: calc(100vh - 120px);
  }
}
</style>
