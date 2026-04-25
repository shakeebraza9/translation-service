<template>
  <v-app id="admin-dashboard" :theme="currentTheme">
    
    <v-navigation-drawer
      v-model="drawer"
      app
      permanent
      width="280"
      color="surface"
      class="border-right"
    >
      <v-list-item class="pa-6">
        <template #prepend>
          <v-avatar size="48" color="primary">
            <v-img :src="avatarImage" />
          </v-avatar>
        </template>
        <template #default>
          <v-list-item-title class="text-h6 font-weight-bold text-white">
            Ajoy Sarker
          </v-list-item-title>
          <v-list-item-subtitle class="text-primary">
            Super Admin
          </v-list-item-subtitle>
        </template>
      </v-list-item>

      <v-divider class="mx-4 opacity-10" />

      <v-list nav class="pa-4">
        <v-list-item
          v-for="item in menuItems"
          :key="item.path"
          :to="item.path"
          :prepend-icon="item.icon"
          :title="item.title"
          rounded="lg"
          color="primary"
          class="mb-2"
        />
      </v-list>

      <template v-slot:append>
        <div class="pa-4">
          <v-btn
            block
            color="error"
            variant="tonal"
            prepend-icon="mdi-logout"
            class="text-capitalize font-weight-bold"
            :loading="loading"
            @click="handleLogout"
          >
            Logout Session
          </v-btn>
        </div>
      </template>

    </v-navigation-drawer>

    <v-app-bar flat border color="surface" height="72">
      <v-toolbar-title>
        Dashboard /
        <span class="text-primary">{{ activePageName }}</span>
      </v-toolbar-title>
    </v-app-bar>

    <v-main class="bg-background">
      <router-view />
    </v-main>

  </v-app>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useUserStore } from '@/stores/userStore'
import avatarImage from '@/assets/avatar.png'
// API call ke liye model import karein (agar aapne banaya hua hai)
import General from '@/models/general.model' 

const drawer = ref(true)
const loading = ref(false)
const currentTheme = ref('adminDark')

const router = useRouter()
const route = useRoute()
const userStore = useUserStore()

const menuItems = [
  { title: 'Overview', icon: 'mdi-view-dashboard-outline', path: '/admin/dashboard' },
  { title: 'Blog Posts', icon: 'mdi-post-outline', path: '/admin/blog' },
  { title: 'Projects', icon: 'mdi-rocket-launch-outline', path: '/admin/projects' },
  { title: 'Settings', icon: 'mdi-account-cog-outline', path: '/admin/settings' },
]

const activePageName = computed(() => {
  return route.name || 'Overview'
})

// Logout Logic with API call
const handleLogout = async () => {
  loading.value = true
  try {
    // 1. API Call (Laravel sanctum/api logout endpoint)
    await General.post('/logout') 
  } catch (error) {
    console.error("Logout API failed, but clearing local session anyway.", error)
  } finally {
    // 2. Clear Local Data (Hamesha execute hoga)
    localStorage.removeItem('auth_token')
    userStore.user = {}
    userStore.is_logged_in = false
    
    loading.value = false
    router.push('/login')
  }
}
</script>

<style scoped>
.border-right {
  border-right: 1px solid rgba(52, 62, 75, 0.6) !important;
}

:deep(.v-list-item--active) {
  background: rgba(0, 128, 255, 0.12) !important;
  border-left: 4px solid #0080FF !important;
  border-radius: 0 12px 12px 0 !important;
  font-weight: 600;
}

:deep(.v-navigation-drawer__content::-webkit-scrollbar) {
  width: 6px;
}
:deep(.v-navigation-drawer__content::-webkit-scrollbar-thumb) {
  background: rgba(255, 255, 255, 0.15);
  border-radius: 10px;
}
</style>