<script setup>
</script>
<template>
<header class="border-gray-500 border-b w-full">
    <div class="  max-w-7xl flex px-4 justify-between items-center mx-auto  m-4 text-center rounded-lg ">
        <div >
            <router-link to="/"> <span class="text-white  font-bold text-4xl  "><span class="pl-4 bg-red-600">All</span><span class="text-red-600">Projects</span></span></router-link>
        </div>
        <div class="md:hidden">
            <i class="bx bx-menu text-4xl"></i>
        </div>
        <ul class="list-none hidden md:flex gap-4 ">
            <li class="py-1 px-8 hover:bg-red-500 hover:text-white transition-all duration-400 rounded-lg">
                <router-link to="/">Home</router-link>
            </li>
            <li class="py-1 px-8 hover:bg-red-500 hover:text-white transition-all duration-400 rounded-lg">
            <router-link to="/about">About</router-link> 
            </li>
            <li class="py-1 px-8 hover:bg-red-500 hover:text-white transition-all duration-400 rounded-lg">
            <router-link to="/blog/posts/all">Blog</router-link> 
            </li>
            <li class="py-1 px-8 hover:bg-red-500 hover:text-white transition-all duration-400 rounded-lg ">
                <router-link to="/login">Login</router-link>
            </li>
            <li class="py-1 px-8 hover:bg-red-500 hover:text-white transition-all duration-400 rounded-lg">
                <router-link to="/myapp">MyApp</router-link>
            </li>
        </ul>
    </div>
</header>
</template>