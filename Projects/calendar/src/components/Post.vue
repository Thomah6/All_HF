<script setup>
import { ref } from 'vue';
const props=defineProps({
    id: Number
})
const url = computed(()=>{
    return "https://dummyjson.com/posts/"+props.id
})
const tab = ref([])
const error = ref('')
onMounted(async () => {
        try {
                const response = await axios.get(url)
                tab.value = response.data
        } catch (err) {
                error.value = err.message
        }
})
</script>
<template>
    <div v-for="post in tab" class="p-4 rounded-lg border border-gray-200 bg-gray-100 text-gray-700">
  <div class="flex items-center gap-4 ">
    <img :src="img(post.userId)" class="w-12 h-12 rounded-lg">
    <div class="text-left">
        <span class="font-semibold text-left">{{ post.title }}</span>
    </div>
  
  </div>
    <div class="border-t-2 mt-4 py-4 text-gray-600 text-lg text-left border-gray-200">
        <p class="">{{ post.body }}</p>
        <div class="flex flex-wrap my-2 wrap-normal gap-2">
            <span v-for="tag in post.tags" class="px-2 py-1 rounded-lg border border-gray-200 bg-white text-gray-700 font-semibold text-sm">
                #{{ tag }}
            </span>
        </div>
    </div>
   <div class="flex gap-4 justify-between">
     <div class="flex gap-4">
        <span class="cursor-pointer flex bg-black/80 text-white border border-gray-200 rounded-2xl px-4 py-1  items-center gap-2"><i class="bx bx-like text-xl"></i> <span class="text-white/50">{{ post.reactions.likes }}</span></span>
        <span class="cursor-pointer flex bg-black/80 text-white border border-gray-200 rounded-2xl px-4 py-1  items-center gap-2"><i class="bx bx-dislike text-xl"></i> <span class="text-white/50">{{ post.reactions.dislikes }}</span></span>
    </div>
    <div>
        <span class="flex text-gray-400 border border-gray-200 rounded-2xl px-4 py-1  items-center gap-2"><i class="bx bx-eye text-xl"></i> <span class="">{{ post.views }}</span></span>
    </div>
   </div>
</div>
</template>