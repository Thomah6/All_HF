<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios'
const product = ref({})
const error = ref(null)
const props = defineProps({
    id: String
})
onMounted(async () => {
    try {
        const response = await axios.get('https://dummyjson.com/products/' + props.id)
        product.value = response.data
        console.log(product.value);

    } catch (err) {
        error.value = err.message
        console.log(error.value);

    }
})

</script>
<template>
    <div class="">

        <span class="mb-4 block text-gray-700">
            <router-link to="/myapp" class="  underline">
                <span class="">MyApp</span>
            </router-link>
            > <router-link to="/myapp/products" class="  underline">
                MyProducts
            </router-link>
            > {{ product.title }}
        </span>


        <div class="max-w-3xl mx-auto bg-white  rounded-lg overflow-hidden border border-gray-200">
            <!-- Image principale -->
            <div class="overflow-hidden relative rounded-lg">
                <img  :src="product?.images?.[0] || product?.thumbnail || '/placeholder.jpg'"  alt="Product image"
                    class="rounded w-full object-contain max-h-80" />
                <span class="flex items-center absolute top-2 right-2 bg-gray-800 text-white text-xs px-3 py-1 rounded-full">
                   <i class="bx bx-pin"></i> {{ product.category }}
                </span>
            </div>

            <!-- Contenu -->
            <div class="p-6">
                <!-- Titre + prix -->
                <div class="flex justify-between items-start mb-2">
                    <h2 class="text-xl font-bold text-gray-800">{{ product.title }}</h2>
                    <p class="text-red-500 text-lg font-semibold">${{ product.price }}</p>
                </div>

                <!-- Description -->
                <p class="text-gray-600 text-sm mb-4">{{ product.description }}</p>

                <div class="flex flex-wrap gap-2 mb-4">
                    <span v-for="tag in product.tags" :key="tag"
                        class="px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded-full border border-gray-200">
                        #{{ tag }}
                    </span>
                </div>

                <div class="flex justify-between items-center mb-4">
                    <p class="text-sm font-medium" :class="product.stock > 0 ? 'text-green-600' : 'text-red-600'">
                        Stock: {{ product.stock }}
                    </p>
                    <p class="text-yellow-500 text-sm flex items-center"><i class="bx bxs-star"></i> {{ product.rating }}</p>
                </div>

                <div class="text-xs text-gray-500 mb-4">
                    <p>Brand: <span class="font-medium text-gray-700">{{ product.brand }}</span></p>
                    <p>SKU: {{ product.sku }}</p>
                </div>

                <div class="bg-gray-50 p-3 rounded-lg text-xs text-gray-600 mb-4">
                    <span class="flex items-center gap-2 font-semibold text-lg"><i class="bx bx-info-circle"></i> info</span>
                    <p>- {{ product.shippingInformation }}</p>
                    <p>- {{ product.warrantyInformation }}</p>
                    <p>- {{ product.returnPolicy }}</p>
                </div>

                <div class="mt-6">
                    <h3 class="text-sm font-semibold mb-2">Avis des clients :</h3>
                    <div v-for="review in product.reviews" :key="review.reviewerEmail" class="border border-gray-200 rounded-lg mb-4 p-4 py-2">
                        <p class="text-gray-600 text-sm font-medium">{{ review.reviewerName }}</p>
                        <p class="text-yellow-500 text-lg flex items-center"><i class="bx bxs-star"></i> {{ review.rating }}</p>
                        <p class="text-gray-600 text-xs">{{ review.comment }}</p>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>