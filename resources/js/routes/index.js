import { createRouter, createWebHistory } from 'vue-router'
import { useUserStore } from '@/stores/userStore'



import WebLayout from '@/views/web/Layouts/index.vue'
import Projects from '@/views/web/projects.vue'
import Contact from '@/views/web/contact.vue'
import Blog from '@/views/web/BlogView.vue'
import Home from '@/views/web/home.vue'
import Login from '@/views/auth/login.vue'
import NotFound from '@/views/404.vue'

const suburl = import.meta.env.VITE_SUB_URL || '/'

const routes = [

  {
    path: '/',
    component: WebLayout,
    children: [
        {
          path: '', 
          name: 'Home',
          component: Home,
        },{
          path: 'projects', 
          name: 'projects',
          component: Projects,
        },{
          path:'contact',
          name:'contact',
          component:Contact,
        },{
          path:'blog',
          name:'blog',
          component:Blog,
        }
    ]
  },
{
    path: '/login', // <--- Error yahan tha, "/" lazmi hai
    name: 'login',
    component: Login,
  },

  {
    path: '/admin',
    component: () => import('@/views/admin/layout/index.vue'),
    meta: { requiresAuth: true },
    children: [
      {
        path: 'dashboard', 
        name: 'dashboard',
        component: () => import('@/views/admin/Overview.vue'),
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

  // 1. Profile fetch logic (Sirf ek baar jab app load ho)
  if (!auth.checked && localStorage.getItem('auth_token')) {
    try {
      const res = await auth.getProfile()
      auth.user = res.user
      auth.is_logged_in = true
    } catch (e) {
      auth.user = {}
      auth.is_logged_in = false
      localStorage.removeItem('auth_token')
    } finally {
      auth.checked = true // Hamesha true karein taake loop na bane
    }
  } else {
    auth.checked = true
  }

  // 2. Auth Guard: Agar page ko login chahiye aur user logged in nahi hai
  if (to.meta.requiresAuth && !auth.is_logged_in) {
    return next({ name: 'login' }) // Ya '/' jo aap chahein
  }

  // 3. Guest Guard: Agar user logged in hai aur login page par ja raha hai
  // Note: 'dashboard' route ka active hona zaroori hai
  if (to.name === 'login' && auth.is_logged_in) {
    // Check karein ke dashboard route exists karta hai ya nahi
    return next('/') 
  }

  next()
})

export default router
