<template>
  <v-app id="admin-dashboard" :theme="currentTheme">
    <v-navigation-drawer
      v-model="drawer"
      app
      permanent
      elevation="4"
      color="surface"
      class="border-right"
      width="280"
    >
      <!-- Logo / User Info -->
      <v-list-item class="pa-6">
        <template v-slot:prepend>
          <v-avatar size="48" border="primary">
            <v-img :src="avatarImage" alt="Ajoy Sarker"></v-img>
          </v-avatar>
        </template>
        <v-list-item-title class="text-h6 font-weight-bold text-white">
          Muhammad Shakeeb Raza
        </v-list-item-title>
        <v-list-item-subtitle class="text-primary font-weight-medium">
          Super Admin
        </v-list-item-subtitle>
      </v-list-item>

      <v-divider class="mx-4 opacity-10"></v-divider>

      <!-- Menu -->
      <v-list nav class="pa-4">
        <v-list-item
          v-for="item in menuItems"
          :key="item.title"
          :to="item.path"
          :prepend-icon="item.icon"
          :title="item.title"
          rounded="lg"
          active-color="primary"
          class="mb-2 nav-link"
        ></v-list-item>
      </v-list>

      <!-- Logout -->
      <template v-slot:append>
        <div class="pa-4">
          <v-btn
            block
            color="error"
            variant="tonal"
            prepend-icon="mdi-logout"
            class="font-weight-bold text-capitalize"
            @click="logout"
          >
            Logout
          </v-btn>
        </div>
      </template>
    </v-navigation-drawer>

    <!-- App Bar -->
    <v-app-bar flat border color="surface" class="px-4" height="72">
      <v-app-bar-nav-icon 
        @click="drawer = !drawer" 
        class="hidden-lg-and-up"
      ></v-app-bar-nav-icon>

      <v-toolbar-title class="font-weight-medium text-body-1">
        Dashboard / 
        <span class="text-primary">{{ activePageName }}</span>
      </v-toolbar-title>

      <v-spacer></v-spacer>


      <v-btn
        variant="flat"
        color="primary"
        prepend-icon="mdi-plus"
        rounded="pill"
        size="small"
        class="font-weight-bold px-6"
      >
        New Project
      </v-btn>
    </v-app-bar>

    <!-- Main Content -->
    <v-main class="bg-background">
      <router-view v-slot="{ Component }">
        <v-fade-transition mode="out-in">
          <component :is="Component" />
        </v-fade-transition>
      </router-view>
    </v-main>
  </v-app>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useUserStore } from '@/stores/userStore'
import avatarImage from '@/assets/avatar.png'

const drawer = ref(true)
const router = useRouter()
const route = useRoute()
const userStore = useUserStore()

const menuItems = [
  { title: 'Overview', icon: 'mdi-view-dashboard-outline', path: '/user/dashboard' },
  { title: 'My Projects', icon: 'mdi-folder-outline', path: '/user/projects' },
  { title: 'Blog Posts', icon: 'mdi-post-outline', path: '/user/blogs' },
  { title: 'Messages', icon: 'mdi-email-outline', path: '/user/messages' },
  { title: 'Settings', icon: 'mdi-account-cog-outline', path: '/user/settings' },
]

const activePageName = computed(() => {
  return route.meta.title || route.name || 'Overview'
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

.nav-link {
  transition: all 0.2s ease;
}

:deep(.v-list-item--active) {
  background: rgba(0, 128, 255, 0.12) !important;
  border-left: 4px solid #0080FF !important;
  border-radius: 0 12px 12px 0 !important;
}

:deep(.v-navigation-drawer__content::-webkit-scrollbar) {
  width: 6px;
}
:deep(.v-navigation-drawer__content::-webkit-scrollbar-thumb) {
  background: rgba(255, 255, 255, 0.15);
  border-radius: 10px;
}
</style>