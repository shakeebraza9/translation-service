import { createRouter, createWebHistory } from 'vue-router'
import { useUserStore } from '@/stores/userStore'
import adminRoute from './adminRoute'

const WebLayout = () => import('@/views/web/Layouts/index.vue')
const Home = () => import('@/views/web/home.vue')


const suburl = import.meta.env.VITE_SUB_URL || '/'

const routes = [
  {
    path: '/',
    component: WebLayout,
    children: [
      { path: '', name: 'Home', component: Home },
      { path: 'projects', name: 'projects', component: () => import('@/views/web/projects.vue') },
      { path: 'project/:slug', name: 'projects-detail', component: () => import('@/views/web/project-detail.vue') },
      { path: 'contact', name: 'contact', component: () => import('@/views/web/contact.vue') },
      { path: 'blog', name: 'blog', component: () => import('@/views/web/BlogView.vue') },
      { path: 'blog/:slug', name: 'blog-detail', component: () => import('@/views/web/BlogDetailView.vue') },
    ]
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('@/views/auth/login.vue'),
    meta: { guestOnly: true } 
  },
  ...adminRoute.map(route => {
    // route.meta = { ...route.meta, requiresAuth: true };
    return route;
  }),
  {
    path: '/:pathMatch(.*)*',
    name: 'NotFound',
    component: () => import('@/views/404.vue'),
  },
]

const router = createRouter({
  history: createWebHistory(suburl),
  routes,
})

router.beforeEach(async (to, from, next) => {
  const auth = useUserStore()
  const token = localStorage.getItem('auth_token')


  if (!auth.checked && token) {
    try {
      await auth.getProfile() 
    } catch (e) {
      localStorage.removeItem('auth_token')
    } finally {
      auth.checked = true
    }
  } else if (!token) {
    auth.checked = true
    auth.is_logged_in = false
  }


  if (to.meta.requiresAuth && !auth.is_logged_in) {
    return next({ name: 'login' })
  }

  if (to.meta.guestOnly && auth.is_logged_in) {
    return next({ name: 'dashboard' }) 
  }

  next()
})

export default router