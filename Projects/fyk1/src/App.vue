<script setup>
import {ref} from 'vue'
import Header from '@/components/Header.vue'
import DeskSidebar from '@/components/DeskSidebar.vue'
import MobileSidebar from '@/components/MobileSidebar.vue'
import Footer from '@/components/Footer.vue'
</script>
<template>
    <div class="bg-gray-50 dark:bg-neutral-900 text-gray-800 dark:text-neutral-200 min-h-screen lg:pl-64">

        <Header />
        <DeskSidebar />
        <MobileSidebar />
        <router-view />
        <Footer />
    </div>
    </template>