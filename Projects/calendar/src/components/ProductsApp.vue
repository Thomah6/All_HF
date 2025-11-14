<script setup>
import { ref, onMounted , watch} from 'vue';
import axios from 'axios'
const products = ref([])
const q=ref('')
const productsFiltered=ref([])
const error = ref(null)

onMounted(async () => {
    try {
        const response = await axios.get('https://dummyjson.com/products')
        products.value = response.data.products
        productsFiltered.value = response.data.products

    } catch (err) {
        error.value = err.message
    }
})

watch(q, async (newVal) => {
  const search = newVal.toLowerCase()

  productsFiltered.value = products.value.filter((product) => {
    return (
      product.title.toLowerCase().includes(search) ||
      product.description.toLowerCase().includes(search) ||
      product.category.toLowerCase().includes(search) ||
      product.tags.some(tag => tag.toLowerCase().includes(search))
    )
  })
})

</script>
<template>
    <div class="">
        <span class="mb-4 block text-gray-700">
            <router-link to="/myapp" class="underline">
                <span class="">MyApp</span>
            </router-link>
            > MyProducts
        </span>

        <div class="grid gap-4 ">
            <div class="border border-gray-200 p-2 rounded-lg">
<input v-model="q" type="type" class=" w-full px-4 py-2 outline-none" placeholder="Search..." autofocus>
  
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div v-for="product in productsFiltered" :key="product.id"
                    class="overflow-hidden relative p-2 border border-gray-200 rounded-lg">
                    <img :src="product.images[0]" class="rounded" />
                    <div class="mb-8">
                        <div class="relative">

                            <p class="text-gray-700 mr-12 text-lg font-semibold">{{ product.title }}</p>
                            <div class="absolute top-0 right-0">
                                <p class="text-red-400 font-bold text-lg">${{ product.price }}</p>
                            </div>

                        </div>
                        <div class="text-sm text-nowrap text-ellipsis overflow-hidden text-gray-600">{{
                            product.description }}</div>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="tag in product.tags"
                                class="text-nowrap px-2 py-1 text-xs bg-gray-100 rounded-lg border border-gray-200 ">
                                #{{ tag }}</span>
                        </div>
                    </div>
                    <router-link :to="`/products/${product.id}`"
                        class="text-sm absolute bottom-2 right-2 text-gray-700 flex items-center text-red-500"><span
                            class="underline">Details </span><i class="bx bx-arrow-right"></i></router-link>
                    <span class="bg-gray-700 text-white text-sm px-4 py-1 rounded-b-xl absolute top-0 right-0">{{
                        product.category }}</span>
                </div>
            </div>
        </div>
    </div>
</template>
