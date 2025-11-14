<script setup>
import { ref, onMounted } from 'vue'
import { supabase } from '@/lib/supabase'

const keys = ref([])
const loading = ref(false)
const message = ref('')
const newName = ref('')
const generatedToken = ref('')
const copied = ref(false)

async function fetchPrimaryKeys() {
  loading.value = true
  try {
    const { data, error } = await supabase
      .from('primary_keys')
      .select('id, name, status, created_at, last_used_at')
      .order('created_at', { ascending: false })
    if (error) throw error
    keys.value = data || []
  } catch (err) {
    console.error(err)
  } finally {
    loading.value = false
  }
}

async function generate() {
  message.value = ''
  generatedToken.value = ''
  try {
    const { data, error } = await supabase.rpc('generate_primary_key', { p_name: newName.value || null })
    if (error) throw error
    generatedToken.value = data
    newName.value = ''
    await fetchPrimaryKeys()
  } catch (err) {
    console.error(err)
    message.value = "Erreur lors de la génération de la clé"
  }
}

function copyToken() {
  if (!generatedToken.value) return
  navigator.clipboard.writeText(generatedToken.value)
    .then(() => { copied.value = true; setTimeout(() => (copied.value = false), 2000) })
    .catch(() => {})
}

async function setStatus(id, status) {
  try {
    const { error } = await supabase.rpc('set_primary_key_status', { p_id: id, p_status: status })
    if (error) throw error
    await fetchPrimaryKeys()
  } catch (err) {
    console.error(err)
  }
}

async function remove(id) {
  try {
    const { error } = await supabase.rpc('delete_primary_key', { p_id: id })
    if (error) throw error
    await fetchPrimaryKeys()
  } catch (err) {
    console.error(err)
  }
}

onMounted(fetchPrimaryKeys)
</script>

<template>
  <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-4">
      <h1 class="text-2xl font-bold">Primary API Keys</h1>
    </div>

    <!-- Génération -->
    <div class="card bg-base-100 shadow mb-6">
      <div class="card-body">
        <div v-if="message" class="alert alert-error">{{ message }}</div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 items-end">
          <div class="form-control md:col-span-2">
            <label class="label"><span class="label-text">Nom (optionnel)</span></label>
            <input v-model="newName" type="text" class="input input-bordered" placeholder="ex: prod-app" />
          </div>
          <button class="btn btn-primary" @click="generate">Générer</button>
        </div>
        <div v-if="generatedToken" class="alert alert-info mt-4">
          <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3">
            <input class="input input-bordered w-full font-mono" :value="generatedToken" readonly />
            <button class="btn" @click="copyToken">
              <span v-if="!copied">Copier</span>
              <span v-else>Copié ✓</span>
            </button>
          </div>
          <p class="text-xs mt-2 opacity-70">Affichée une seule fois. Sauvegarde-la en lieu sûr.</p>
        </div>
      </div>
    </div>

    <!-- Liste -->
    <div class="card bg-base-100 shadow">
      <div class="card-body">
        <div v-if="loading" class="loading loading-spinner"></div>
        <div v-else class="overflow-x-auto">
          <table class="table">
            <thead>
              <tr>
                <th>Nom</th>
                <th>Status</th>
                <th>Cr��ée</th>
                <th>Dernier usage</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="pk in keys" :key="pk.id">
                <td class="font-mono">{{ pk.name }}</td>
                <td>
                  <span :class="['badge', pk.status === 'active' ? 'badge-success' : 'badge-ghost']">{{ pk.status }}</span>
                </td>
                <td>{{ new Date(pk.created_at).toLocaleString() }}</td>
                <td>{{ pk.last_used_at ? new Date(pk.last_used_at).toLocaleString() : '-' }}</td>
                <td class="flex gap-2">
                  <button class="btn btn-sm" @click="setStatus(pk.id, pk.status === 'active' ? 'inactive' : 'active')">
                    {{ pk.status === 'active' ? 'Désactiver' : 'Activer' }}
                  </button>
                  <button class="btn btn-sm btn-error" @click="remove(pk.id)">Supprimer</button>
                </td>
              </tr>
              <tr v-if="!keys.length">
                <td colspan="5" class="text-center opacity-60">Aucune clé</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</template>
