import { createRouter, createWebHistory } from 'vue-router'
import { supabase } from '@/lib/supabase'
import AppLayout from '@/layouts/AppLayout.vue'

const routes = [
  {
    path: '/',
    component: AppLayout,
    meta: { requiresAuth: true },
    children: [
      {
        path: '',
        name: 'dash',
        component: () => import('@/views/DashboardView.vue'),
      },
      {
        path: 'profile',
        name: 'profile',
        component: () => import('@/views/ProfileView.vue'),
      },
      {
        path: 'logs',
        name: 'logs',
        component: () => import('@/views/LogsView.vue'),
      },
      {
        path: 'keys/create',
        name: 'keys-create',
        component: () => import('@/views/KeysAddView.vue'),
      },
      {
        path: 'keys',
        name: 'keys-list',
        component: () => import('@/views/KeysListView.vue'),
      },
      {
        path: 'keys/:name',
        name: 'key-detail',
        component: () => import('@/views/KeyDetailView.vue'),
      },
      {
        path: 'primary-keys',
        name: 'primary-keys',
        component: () => import('@/views/PrimaryKeysView.vue'),
      },
      {
        path: 'docs',
        name: 'docs',
        component: () => import('@/views/DocsView.vue'),
      },
      {
        path: 'settings',
        name: 'settings',
        component: () => import('@/views/SettingsView.vue'),
      }
    ]
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('@/views/LoginView.vue'),
    meta: { requiresAuth: false }
  },
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

router.beforeEach(async (to) => {
  if (!to.meta?.requiresAuth) return true
  const {
    data: { session }
  } = await supabase.auth.getSession()
  if (!session) {
    return { name: 'login', query: { redirect: to.fullPath } }
  }
  return true
})

export default router
