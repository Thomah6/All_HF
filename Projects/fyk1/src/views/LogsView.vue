<script setup>
import { ref, onMounted, watch } from 'vue'
import { supabase } from '@/lib/supabase'

const fromDate = ref('')
const toDate = ref('')
const keyName = ref('')
const loading = ref(false)
const logs = ref([])

async function fetchLogs() {
  loading.value = true
  try {
    const { data: { user } } = await supabase.auth.getUser()
    if (!user) return
    let query = supabase.from('logs').select('*').eq('user_id', user.id).order('created_at', { ascending: false }).limit(50)
    if (keyName.value) query = query.ilike('key_name', `%${keyName.value}%`)
    if (fromDate.value) query = query.gte('created_at', fromDate.value)
    if (toDate.value) query = query.lte('created_at', toDate.value)
    const { data, error } = await query
    if (error) throw error
    logs.value = data || []
  } catch (err) {
    console.error(err)
  } finally {
    loading.value = false
  }
}

onMounted(fetchLogs)
watch([fromDate, toDate, keyName], fetchLogs)
</script>
<template>
  <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold mb-4">Logs</h1>
    <div class="card bg-base-100 shadow mb-6">
      <div class="card-body grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="form-control">
          <label class="label"><span class="label-text">From</span></label>
          <input v-model="fromDate" type="datetime-local" class="input input-bordered" />
        </div>
        <div class="form-control">
          <label class="label"><span class="label-text">To</span></label>
          <input v-model="toDate" type="datetime-local" class="input input-bordered" />
        </div>
        <div class="form-control md:col-span-2">
          <label class="label"><span class="label-text">Key name</span></label>
          <input v-model="keyName" type="text" class="input input-bordered" placeholder="openai_api_key" />
        </div>
      </div>
    </div>

    <div class="card bg-base-100 shadow">
      <div class="card-body">
        <div v-if="loading" class="loading loading-spinner"></div>
        <div v-else class="overflow-x-auto">
          <table class="table">
            <thead>
              <tr>
                <th>Time</th>
                <th>Key</th>
                <th>Status</th>
                <th>IP</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="log in logs" :key="log.id">
                <td>{{ new Date(log.created_at).toLocaleString() }}</td>
                <td>{{ log.key_name }}</td>
                <td>{{ log.result_code }}</td>
                <td>{{ log.ip || '-' }}</td>
              </tr>
              <tr v-if="!logs.length">
                <td colspan="4" class="text-center opacity-60">No logs</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
</template>
