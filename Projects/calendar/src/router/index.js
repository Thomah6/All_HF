import { createRouter, createWebHistory } from 'vue-router'
import BlogView from '@/views/BlogView.vue'
import MyAppView from '@/views/MyappView.vue'
import AboutView from '@/views/AboutView.vue'
import LoginView from '@/views/LoginView.vue'
import HomeView from '@/views/HomeView.vue'
import MyAppHome from '@/components/MyAppHome.vue'
import ProductsApp from '@/components/ProductsApp.vue'
import CalendarApp from '@/components/CalendarApp.vue'
import AllPosts from '@/components/AllPosts.vue'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: HomeView,
    },
    {
      path: '/About',
      component: AboutView,
    },
    {
      path: '/Blog',
      component: BlogView,
      children:[
        {
          path:'posts/t/:tag',
          component: AllPosts,
          name:'all',
          props:true
        },
        {
          path:'posts/all',
          component: AllPosts
        }
        
        
      ]
    },
    {
      path: '/login',
      name: '',
      component: LoginView,
    },
    {
      path: '/myapp',
      component: MyAppView,
      children: [
        {
          path: '',
          component: MyAppHome,
        },
        {
          path: 'calendar',
          component: CalendarApp,
        },
        {
          path: 'products',
          component: ProductsApp,
        },
        {
          path: '/products/:id',
          name: 'ProductDetails',
          component: () => import('@/components/ProductDetails.vue'),
          props:true
        },
      ],
    },
  ],
})

export default router
