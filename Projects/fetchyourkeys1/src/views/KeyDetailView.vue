<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { supabase } from '@/lib/supabase'

const route = useRoute()
const name = decodeURIComponent(route.params.name)
const k = ref(null)
const loading = ref(false)
const message = ref('')

async function fetchKey() {
  loading.value = true
  try {
    const { data, error } = await supabase
      .from('keys')
      .select('id, name, service, environment, status, description, created_at, last_used_at, expires_at')
      .eq('name', name)
      .single()
    if (error) throw error
    k.value = data
  } catch (err) {
    console.error(err)
    message.value = 'Erreur lors du chargement de la clé'
  } finally {
    loading.value = false
  }
}

async function toggleStatus() {
  if (!k.value) return
  const next = k.value.status === 'active' ? 'inactive' : 'active'
  try {
    const { error } = await supabase
      .from('keys')
      .update({ status: next })
      .eq('id', k.value.id)
    if (error) throw error
    k.value.status = next
  } catch (err) {
    console.error(err)
  }
}

async function removeKey() {
  if (!k.value) return
  try {
    const { error } = await supabase
      .from('keys')
      .delete()
      .eq('id', k.value.id)
    if (error) throw error
    window.location.href = '/keys'
  } catch (err) {
    console.error(err)
  }
}

onMounted(fetchKey)
</script>

<template>
  <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-4">
      <h1 class="text-2xl font-bold">Clé: <span class="font-mono">{{ name }}</span></h1>
      <router-link class="btn" :to="{ name: 'keys-list' }">Retour</router-link>
    </div>

    <div class="card bg-base-100 shadow">
      <div class="card-body">
        <div v-if="loading" class="loading loading-spinner"></div>
        <div v-else-if="k">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <div class="text-sm opacity-70">Service</div>
              <div>{{ k.service || '-' }}</div>
            </div>
            <div>
              <div class="text-sm opacity-70">Environment</div>
              <div>{{ k.environment }}</div>
            </div>
            <div>
              <div class="text-sm opacity-70">Status</div>
              <div><span :class="['badge', k.status === 'active' ? 'badge-success' : 'badge-ghost']">{{ k.status }}</span></div>
            </div>
            <div>
              <div class="text-sm opacity-70">Créée</div>
              <div>{{ new Date(k.created_at).toLocaleString() }}</div>
            </div>
            <div>
              <div class="text-sm opacity-70">Dernier accès</div>
              <div>{{ k.last_used_at ? new Date(k.last_used_at).toLocaleString() : '-' }}</div>
            </div>
            <div>
              <div class="text-sm opacity-70">Expiration</div>
              <div>{{ k.expires_at ? new Date(k.expires_at).toLocaleString() : '-' }}</div>
            </div>
          </div>

          <div class="mt-6 flex gap-2">
            <button class="btn" @click="toggleStatus">{{ k.status === 'active' ? 'Désactiver' : 'Activer' }}</button>
            <button class="btn btn-error" @click="removeKey">Supprimer</button>
          </div>
        </div>
        <div v-else>
          <div class="alert alert-error">Clé introuvable</div>
        </div>
      </div>
    </div>
  </main>
</template>
