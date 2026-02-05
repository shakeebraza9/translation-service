import { createRouter, createWebHistory } from 'vue-router'
import { useUserStore } from '@/stores/userStore'
import { useAlertStore } from '@/stores/alertStore'

import Layout from '@/views/Layouts/index.vue'
import Dashboard from '@/views/dashboard/index.vue'
import NotFound from '@/views/404.vue'

const suburl = import.meta.env.VITE_SUB_URL || '/'

const routes = [
  {
    path: '/',
    component: Layout,
    children: [
      {
        path: 'dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: { requiresAuth: true },
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
  const alertStore = useAlertStore()

  try {
    const res = await auth.getProfile()
    auth.user = res.user
    auth.is_logged_in = true
  } catch (e) {
    auth.user = {}
    auth.is_logged_in = false
    localStorage.removeItem('auth_token')
  }

  if (to.meta.requiresAuth && !auth.is_logged_in) {
    next('/login')
  } else {
    next()
  }
})

export default router
