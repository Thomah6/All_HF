<script setup>

</script>
<template>
  <div class="w-full ">

<div class=" grid gap-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
<span class="flex items-center text-black/50"><i class="bx bx-menu mr-2"></i> Menu</span>
    <ul class="grid gap-4">
    <li ><router-link class="py-2 px-4 border border-gray-200 cursor-pointer rounded-lg bg-white block" to="/myapp/calendar"><i class="bx bx-calendar"></i> My Calendar</router-link></li>
    <li><router-link class="py-2 px-4 border border-gray-200 cursor-pointer rounded-lg bg-white block" to="/myapp/products"><i class='bx bx-shopping-bag'></i> My Products</router-link></li>
</ul>
</div>

  </div>
</template>
