<script setup>
import { useRouter } from 'vue-router'
import { supabase } from '@/lib/supabase'

const router = useRouter()
async function logout() {
  try {
    await supabase.auth.signOut()
  } finally {
    router.push({ name: 'login' })
  }
}
</script>
<template>
     <!-- Desktop Sidebar -->
  <aside class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:z-40 lg:flex lg:w-64 lg:flex-col bg-white dark:bg-neutral-800 border-r border-gray-200 dark:border-neutral-700">
    <div class="h-16 flex items-center px-4 border-b border-gray-200 dark:border-neutral-700">
      <span class="text-sm font-semibold text-gray-700 dark:text-neutral-300">Navigation</span>
    </div>
    <nav class="flex-1 p-3 space-y-1">
      <router-link :to="{ name: 'dash' }" class="flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium bg-red-50 text-red-700 dark:bg-red-900/20 dark:text-red-300">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 21V12h6v9"/></svg>
        <span>Dashboard</span>
      </router-link>
      <router-link :to="{ name: 'keys-list' }" class="flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 dark:text-neutral-300 dark:hover:bg-neutral-700">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10l8 8m0 0h-3m3 0v-3"/></svg>
        <span>API Keys Stocked</span>
      </router-link>

      <router-link :to="{ name: 'logs' }" class="flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 dark:text-neutral-300 dark:hover:bg-neutral-700">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M4 17h16"/></svg>
        <span>Logs</span>
      </router-link>
      <router-link :to="{ name: 'docs' }" class="flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 dark:text-neutral-300 dark:hover:bg-neutral-700">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5h12a2 2 0 012 2v12a3 3 0 00-3-3H4z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5v14a3 3 0 013-3h11"/></svg>
        <span>Docs</span>
      </router-link>
      <div class="pt-2 border-t border-gray-200 dark:border-neutral-700 mt-2"></div>
      <router-link :to="{ name: 'settings' }" class="flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 dark:text-neutral-300 dark:hover:bg-neutral-700">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8a6 6 0 009 5l5 5 2-2-5-5a6 6 0 10-11-3z"/></svg>
        <span>Settings</span>
      </router-link>
      <router-link :to="{ name: 'profile' }" class="flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 dark:text-neutral-300 dark:hover:bg-neutral-700">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><circle cx="12" cy="7" r="4"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 21v-1a7 7 0 0114 0v1"/></svg>
        <span>Profile</span>
      </router-link>
      <router-link :to="{ name: 'primary-keys' }" class="flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 dark:text-neutral-300 dark:hover:bg-neutral-700">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l7 4v6c0 5-3.5 9-7 10-3.5-1-7-5-7-10V6l7-4z"/></svg>
        <span>Primary API Key</span>
      </router-link>
      <button class="flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 dark:text-neutral-300 dark:hover:bg-neutral-700 w-full text-left" @click="logout">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4H7a2 2 0 00-2 2v12a2 2 0 002 2h5"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H9"/></svg>
        <span>Logout</span>
      </button>
    </nav>
  </aside>

</template>