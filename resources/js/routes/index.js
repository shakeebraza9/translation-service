import { createRouter, createWebHistory } from 'vue-router'
import { useUserStore } from '@/stores/userStore'


import Layout from '@/views/Layouts/index.vue'
import Login from '@/views/auth/Login.vue'
import Dashboard from '@/views/dashboard/index.vue'
import NotFound from '@/views/404.vue'

const suburl = import.meta.env.VITE_SUB_URL || '/'

const routes = [

  {
    path: '/',
    name: 'login',
    component: Login,
  },


  {
    path: '/user',
    component: Layout,
    meta: { requiresAuth: true },
    children: [
      {
        path: 'dashboard', 
        name: 'dashboard',
        component: Dashboard,
      },
    ],
  },


  {
    path: '/:pathMatch(.*)*',
    name: 'NotFound',
    component: NotFound,
  },
]

const router = createRouter({
  history: createWebHistory(suburl),
  routes,
})

router.beforeEach(async (to, from, next) => {
  const auth = useUserStore()

  if (!auth.checked) {
    try {
      const res = await auth.getProfile()
      auth.user = res.user
      auth.is_logged_in = true
    } catch (e) {
      auth.user = {}
      auth.is_logged_in = false
      localStorage.removeItem('auth_token')
    }
    auth.checked = true
  }


  if (to.meta.requiresAuth && !auth.is_logged_in) {
    return next('/') 
  }

  if (to.name === 'login' && auth.is_logged_in) {
    return next({ name: 'dashboard' })
  }

  next()
})

export default router
