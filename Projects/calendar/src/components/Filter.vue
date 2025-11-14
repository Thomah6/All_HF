<script setup>
import { ref,computed } from 'vue'
const props = defineProps({
    posts: Array
})

const toutesLesBalises =computed(()=>{
    return props.posts.reduce((acc, post) =>acc.concat(post.tags), []); 
})
const tagsUniques = computed(()=>[...new Set(toutesLesBalises.value)]); 


const rout= (tag)=>{
    return "/blog/posts/t/"+tag
}
// console.log(tagsUniques);

</script>
<template>
  <div class="w-1/4 ">
    <!-- {{ posts }} -->
    <div class="w-auto grid gap-4">
        <div class="text-sm text-gray-400">{{ posts.length }} Posts</div>
   <span class="py-1 bg-gray-100 border border-gray-200 rounded-lg px-4">Tags</span>
        <ul class="grid gap-2 text-gray-500">
           
    <li class=" underline">
         <router-link to="/blog/posts/all">
        <span > All tags</span>
    </router-link>
    </li>
    <li v-for="tagName in tagsUniques" class=" underline">
         <router-link :to="rout(tagName)">
        <span > {{  tagName }}</span>
    </router-link>
    </li>
   </ul>
  </div>
  </div>
</template>
