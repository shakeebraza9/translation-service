<template>
  <v-app id="admin-dashboard" :theme="currentTheme">
    
    <!-- SIDEBAR -->
    <v-navigation-drawer
      v-model="drawer"
      app
      permanent
      width="280"
      color="surface"
      class="border-right"
    >
      
      <!-- USER INFO -->
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

      <!-- MENU -->
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

    </v-navigation-drawer>

    <!-- TOP BAR -->
    <v-app-bar flat border color="surface" height="72">
      <v-toolbar-title>
        Dashboard /
        <span class="text-primary">{{ activePageName }}</span>
      </v-toolbar-title>
    </v-app-bar>

    <!-- CONTENT -->
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


const drawer = ref(true)
const currentTheme = ref('adminDark')

const router = useRouter()
const route = useRoute()
const userStore = useUserStore()

const menuItems = [
  { title: 'Overview', icon: 'mdi-view-dashboard-outline', path: '/admin/dashboard' },
  { title: 'Blog Posts', icon: 'mdi-post-outline', path: '/admin/blog' },
  { title: 'Settings', icon: 'mdi-account-cog-outline', path: '/admin/settings' },
]

const activePageName = computed(() => {
  return route.name || 'Overview'
})

const logout = () => {
  localStorage.removeItem('auth_token')
  userStore.user = {}
  userStore.is_logged_in = false
  router.push('/login')
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