<script setup>
import { ref, onMounted, watch } from 'vue'
import { supabase } from '@/lib/supabase'

const keys = ref([])
const loading = ref(false)
const search = ref('')
const envFilter = ref('')
const statusFilter = ref('')

async function fetchKeys() {
  loading.value = true
  try {
    let query = supabase.from('keys').select('id, name, service, environment, status, last_used_at, created_at').order('created_at', { ascending: false })
    if (search.value) query = query.ilike('name', `%${search.value}%`)
    if (envFilter.value) query = query.eq('environment', envFilter.value)
    if (statusFilter.value) query = query.eq('status', statusFilter.value)
    const { data, error } = await query
    if (error) throw error
    keys.value = data || []
  } catch (err) {
    console.error(err)
  } finally {
    loading.value = false
  }
}

function goToDetail(name) {
  window.location.href = `/keys/${encodeURIComponent(name)}`
}

onMounted(fetchKeys)
watch([search, envFilter, statusFilter], fetchKeys)
</script>

<template>
  <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-4">
      <h1 class="text-2xl font-bold">API Keys</h1>
      <router-link class="btn btn-primary" :to="{ name: 'keys-create' }">Nouvelle clé</router-link>
    </div>

    <div class="card bg-base-100 shadow mb-4">
      <div class="card-body grid grid-cols-1 md:grid-cols-4 gap-3">
        <input v-model="search" type="text" class="input input-bordered" placeholder="Rechercher par nom" />
        <select v-model="envFilter" class="select select-bordered">
          <option value="">Env: Tous</option>
          <option value="dev">dev</option>
          <option value="staging">staging</option>
          <option value="prod">prod</option>
        </select>
        <select v-model="statusFilter" class="select select-bordered">
          <option value="">Status: Tous</option>
          <option value="active">active</option>
          <option value="inactive">inactive</option>
        </select>
      </div>
    </div>

    <div class="card bg-base-100 shadow">
      <div class="card-body">
        <div v-if="loading" class="loading loading-spinner"></div>
        <div v-else class="overflow-x-auto">
          <table class="table">
            <thead>
              <tr>
                <th>Nom</th>
                <th>Service</th>
                <th>Env</th>
                <th>Status</th>
                <th>Dernier accès</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="k in keys" :key="k.id">
                <td class="font-mono">{{ k.name }}</td>
                <td>{{ k.service || '-' }}</td>
                <td>{{ k.environment }}</td>
                <td>
                  <span :class="['badge', k.status === 'active' ? 'badge-success' : 'badge-ghost']">{{ k.status }}</span>
                </td>
                <td>{{ k.last_used_at ? new Date(k.last_used_at).toLocaleString() : '-' }}</td>
                <td>
                  <router-link class="btn btn-sm" :to="{ name: 'key-detail', params: { name: k.name } }">Voir</router-link>
                </td>
              </tr>
              <tr v-if="!keys.length">
                <td colspan="6" class="text-center opacity-60">Aucune clé</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</template>
