<script setup>
import { ref, onMounted, watch } from 'vue'
import axios from 'axios'
import SearchPost from '@/components/SearchPost.vue'
import AllPosts from '@/components/AllPosts.vue'
import Filter from '@/components/Filter.vue'

const postsFiltered = ref([])
const myData = ref([])
const error = ref('')
const q = ref('')
onMounted(async () => {
        try {
                const response = await axios.get('https://dummyjson.com/posts')
                myData.value = response.data.posts
                postsFiltered.value = myData.value
        } catch (err) {
                error.value = err.message
        }
})

watch(() => q.value, () => {
        postsFiltered.value = myData.value.filter((post) => {
                return post.title.toLowerCase().includes(q.value.toLowerCase()) ||
                        post.body.toLowerCase().includes(q.value.toLowerCase())
        })
})

</script>
<template>

        <div class="">
                <SearchPost @search="(qu) => q = qu" />
                        <div class="px-4 flex gap-4 max-w-7xl mx-auto">
<Filter :posts="postsFiltered" />
<router-view :posts="postsFiltered"></router-view>
                        </div>

        </div>
</template>