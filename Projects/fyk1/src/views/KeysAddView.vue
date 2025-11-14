<script setup>
import { ref } from 'vue'
import { supabase } from '@/lib/supabase'

const name = ref('')
const value = ref('')
const service = ref('')
const environment = ref('dev')
const status = ref('active')
const description = ref('')
const saving = ref(false)
const message = ref('')

function normalizeName(n) {
  return (n || '').trim().toLowerCase().replace(/[^a-z0-9_-]/g, '-')
}

async function submitForm() {
  message.value = ''
  const { data: { user } } = await supabase.auth.getUser()
  if (!user) {
    message.value = 'Not authenticated'
    return
  }
  if (!name.value || !value.value) {
    message.value = 'Name and value are required'
    return
  }
  try {
    saving.value = true
    const row = {
      user_id: user.id,
      name: normalizeName(name.value),
      value: value.value,
      service: service.value || 'custom',
      environment: environment.value || 'dev',
      status: status.value || 'active',
      description: description.value || null
    }
    const { error } = await supabase.from('keys').insert(row)
    if (error) throw error
    message.value = 'Key created'
    name.value = ''
    value.value = ''
    service.value = ''
    description.value = ''
    environment.value = 'dev'
    status.value = 'active'
  } catch (err) {
    console.error(err)
    message.value = 'Error creating key'
  } finally {
    saving.value = false
  }
}
</script>
<template>
  <main class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold mb-6">Add API Key</h1>
    <div class="card bg-base-100 shadow">
      <div class="card-body">
        <div v-if="message" class="alert" :class="{'alert-success': message==='Key created', 'alert-error': message && message!=='Key created'}">{{ message }}</div>
        <div class="form-control">
          <label class="label"><span class="label-text">Name</span></label>
          <input v-model="name" type="text" class="input input-bordered" placeholder="openai_api_key" />
        </div>
        <div class="form-control">
          <label class="label"><span class="label-text">Value</span></label>
          <input v-model="value" type="password" class="input input-bordered" placeholder="sk-..." />
        </div>
        <div class="form-control">
          <label class="label"><span class="label-text">Service</span></label>
          <input v-model="service" type="text" class="input input-bordered" placeholder="OpenAI" />
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="form-control">
            <label class="label"><span class="label-text">Environment</span></label>
            <select v-model="environment" class="select select-bordered">
              <option value="dev">dev</option>
              <option value="staging">staging</option>
              <option value="prod">prod</option>
            </select>
          </div>
          <div class="form-control">
            <label class="label"><span class="label-text">Status</span></label>
            <select v-model="status" class="select select-bordered">
              <option value="active">active</option>
              <option value="inactive">inactive</option>
            </select>
          </div>
        </div>
        <div class="form-control">
          <label class="label"><span class="label-text">Description</span></label>
          <textarea v-model="description" class="textarea textarea-bordered" rows="3" placeholder="Optional"></textarea>
        </div>
        <div class="card-actions justify-end">
          <button class="btn btn-primary" :disabled="saving" @click="submitForm">Create</button>
        </div>
      </div>
    </div>
  </main>
  
</template>
