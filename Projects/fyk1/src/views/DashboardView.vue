<script setup>
import {ref} from 'vue'
import Header from '@/components/Header.vue'

</script>
<template>

  <!-- Main content -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Banner -->
    <div class="bg-gradient-to-r from-red-600 to-indigo-700 rounded-xl shadow-md p-6 mb-8 text-white">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div class="mb-4 md:mb-0">
          <h2 class="text-2xl font-bold">Bienvenue sur FetchYourKeys</h2>
          <p class="mt-1 opacity-90">Gérez vos clés API en toute sécurité depuis un seul endroit</p>
        </div>
        <router-link :to="{ name: 'keys-create' }" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
          <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
          </svg>
          Ajouter une clé
        </router-link>
      </div>
    </div>

    <!-- snippet code for every environment and  -->
    

    <!-- Stats grid -->
    


    <!-- Recent requests logs section -->
    
  </main>
</template>