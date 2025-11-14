<script setup>
import { ref } from 'vue'
import Sidebar from '@/components/Sidebar.vue'
</script>
<template>
  <div class="w-full max-w-7xl grid md:flex justify-center gap-4 mx-auto py-20 rounded-2xl">
    <div class="w-full md:w-1/3 flex justify-center">
      <Sidebar />
    </div>
    <div class="w-full md:w-2/3">
      <router-view></router-view>
    </div>
  </div>
</template>
