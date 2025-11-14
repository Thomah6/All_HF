<template>
  <div class="min-h-screen flex items-center justify-center p-6">
    <div class="card w-full max-w-sm bg-base-100 shadow">
      <div class="card-body">
        <h2 class="card-title justify-center">Sign in</h2>
        <button class="btn btn-neutral" @click="signInWithProvider('google')">Continue with Google</button>
        <button class="btn" @click="signInWithProvider('github')">Continue with GitHub</button>
      </div>
    </div>
  </div>
  
</template>

<script setup>
import { onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { supabase } from '@/lib/supabase'

const route = useRoute()
const router = useRouter()

async function signInWithProvider(provider) {
  const { data, error } = await supabase.auth.signInWithOAuth({
    provider,
    options: {
      redirectTo: window.location.origin
    }
  })
  if (error) {
    console.error(error)
  }
}

onMounted(async () => {
  const { data: { session } } = await supabase.auth.getSession()
  if (session) {
    const redirect = route.query.redirect || '/'
    router.replace(redirect)
  }
})
</script>


