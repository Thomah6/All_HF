<template>
  <div class="min-h-screen bg-gray-100 dark:bg-neutral-900">
    <DeskSidebar />
    <MobileSidebar />
    <div class="lg:pl-64 flex flex-col flex-1">
      <Header />
      <main class="flex-1">
        <router-view />
      </main>
      <Footer />
    </div>
  </div>
</template>

<script setup>
import DeskSidebar from '@/components/DeskSidebar.vue'
import MobileSidebar from '@/components/MobileSidebar.vue'
import Header from '@/components/Header.vue'
import Footer from '@/components/Footer.vue'
</script>