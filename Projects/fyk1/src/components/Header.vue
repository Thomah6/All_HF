<script >
import { ref } from 'vue'
import Default_avatar from '@/assets/img/user.png'

 // Gestion du menu utilisateur
</script>
<template>
   <header class="sticky top-0 z-50 bg-white dark:bg-neutral-800 border-b border-gray-200 dark:border-neutral-700 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <!-- Logo -->
        <div class="flex items-center">
          <button id="sidebar-open" class="mr-2 inline-flex items-center justify-center p-2 rounded-md text-gray-700 dark:text-neutral-300 hover:bg-gray-100 dark:hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-red-500 lg:hidden" aria-label="Ouvrir la navigation" aria-controls="mobile-sidebar" aria-expanded="false">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
          <!-- <a href="index.html" class="flex items-center space-x-2"> -->
            <span class="text-xl font-bold text-gray-900 dark:text-white">FetchYourKeys</span>
          <!-- </a> -->
        </div>

        
        <!-- Actions -->
        <div class="flex items-center space-x-4">
          <!-- Search -->
          <div class="hidden md:block relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
              </svg>
            </div>
            <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-neutral-600 rounded-lg bg-gray-100 dark:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 sm:text-sm" placeholder="Rechercher...">
          </div>

          <!-- Theme toggle -->
          <button id="theme-toggle" class="p-2 rounded-lg bg-gray-100 dark:bg-neutral-700 hover:bg-gray-200 dark:hover:bg-neutral-600">
            <svg id="sun-icon" class="h-5 w-5 text-gray-700 dark:text-gray-300 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <svg id="moon-icon" class="h-5 w-5 text-gray-700 dark:text-gray-300 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>
          </button>

          <!-- Profile dropdown -->
          <div class="relative">
            <button id="user-menu-button" class="flex items-center space-x-2 text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
              <img class="h-8 w-8 rounded-full" :src="Default_avatar" alt="Profile">
            </button>
            
            <!-- Dropdown menu -->
            <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-neutral-800 ring-1 ring-black ring-opacity-5 focus:outline-none">
              <div class="py-1" role="none">
                <a href="profile.html" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-neutral-700" role="menuitem">
                  <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="7" r="4"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 21v-1a7 7 0 0114 0v1"/></svg>
                  <span>Profil</span>
                </a>
                <a href="settings.html" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-neutral-700" role="menuitem">
                  <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8a6 6 0 009 5l5 5 2-2-5-5a6 6 0 10-11-3z"/></svg>
                  <span>Paramètres</span>
                </a>
                <a href="logout.html" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-neutral-700" role="menuitem">
                  <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4H7a2 2 0 00-2 2v12a2 2 0 002 2h5"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H9"/></svg>
                  <span>Déconnexion</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>