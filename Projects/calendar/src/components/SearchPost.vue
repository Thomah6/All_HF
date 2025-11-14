<script setup>
import { ref, watch } from 'vue';
const q=ref('')
const emit = defineEmits(['search'])
watch(()=>q.value, ()=>{
    emit('search' ,q.value)
})
</script>
<template>
<div class="w-full relative p-4 max-w-7xl mx-auto">
<input v-model="q" class="outline-none pr-12 w-full border border-gray-200 rounded-lg px-4 py-2 " placeholder="Search...">
<i class="bx bx-search absolute top-4 right-8 text-gray-400 text-xl transform translate-y-1/2"></i>
</div>
</template>