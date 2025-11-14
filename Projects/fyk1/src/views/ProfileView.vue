<script setup>
import { ref, onMounted, computed } from 'vue'
import { supabase } from '@/lib/supabase'
import { truncateEmailToPrefix } from '@/utils/strings'

const user = ref(null)
const loading = ref(false)
const avatarUrl = ref('')

const displayEmail = computed(() => {
  if (!user.value?.email) return ''
  return truncateEmailToPrefix(user.value.email, 5)
})

onMounted(async () => {
  const { data: { user: u } } = await supabase.auth.getUser()
  user.value = u
  const metaUrl = u?.user_metadata?.avatar_url || ''
  avatarUrl.value = metaUrl || '/public/favicon.ico'
})

async function onFileChange(e) {
  const file = e.target.files?.[0]
  if (!file || !user.value) return
  try {
    loading.value = true
    const path = `${user.value.id}.png`
    const { error: uploadError } = await supabase.storage.from('avatars').upload(path, file, { upsert: true, contentType: file.type })
    if (uploadError) throw uploadError
    const { data } = supabase.storage.from('avatars').getPublicUrl(path)
    avatarUrl.value = data.publicUrl
    const { error: updErr } = await supabase.auth.updateUser({ data: { avatar_url: avatarUrl.value } })
    if (updErr) throw updErr
  } catch (err) {
    console.error(err)
  } finally {
    loading.value = false
  }
}
</script>
<template>
  <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold mb-6">Profile</h1>
    <div class="card bg-base-100 shadow">
      <div class="card-body gap-4">
        <div class="flex items-center gap-4">
          <div class="avatar">
            <div class="w-20 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
              <img :src="avatarUrl" alt="avatar" />
            </div>
          </div>
          <div>
            <div class="font-semibold">{{ displayEmail }}</div>
            <div class="text-sm opacity-70">{{ user?.email }}</div>
          </div>
        </div>
        <div class="form-control">
          <label class="label"><span class="label-text">Avatar</span></label>
          <input type="file" accept="image/*" class="file-input file-input-bordered w-full max-w-xs" :disabled="loading" @change="onFileChange" />
        </div>
      </div>
    </div>
  </main>
</template>
