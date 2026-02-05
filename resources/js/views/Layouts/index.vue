<template>
  <div class="layout">

    <header class="header">
      <div class="logo">Translation Service</div>

      <div class="header-right">
        <span class="user-name">{{ user.user.name || 'Guest' }}</span>
        <button @click="logout" class="btn-logout">Logout</button>
      </div>
    </header>


    <div class="body">
      <aside class="sidebar">
        <router-link 
          to="/user/dashboard" 
          class="nav-link" 
          active-class="active"
        >
          Dashboard
        </router-link>

        <router-link 
          to="/user/translations" 
          class="nav-link" 
          active-class="active"
        >
          Translations
        </router-link>

        <router-link 
          to="/user/settings" 
          class="nav-link" 
          active-class="active"
        >
          Settings
        </router-link>
      </aside>

      <main class="main-content">

        <transition name="fade" mode="out-in">
          <router-view />
        </transition>
      </main>
    </div>
  </div>
</template>

<script setup>
import { useUserStore } from '@/stores/userStore'
import { useRouter } from 'vue-router'

const userStore = useUserStore()
const router = useRouter()

const logout = () => {
  userStore.logout()
  router.push('/')
}

const user = userStore
</script>

<style scoped>

.layout {
  display: flex;
  flex-direction: column;
  height: 100vh;
  font-family: Arial, sans-serif;
}


.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 20px;
  background: #1976d2;
  color: #fff;
  height: 60px;
}

.header .logo {
  font-weight: bold;
  font-size: 1.2rem;
}

.header-right {
  display: flex;
  align-items: center;
  gap: 15px;
}

.btn-logout {
  background: #ff4d4f;
  border: none;
  color: #fff;
  padding: 5px 10px;
  border-radius: 4px;
  cursor: pointer;
}


.body {
  display: flex;
  flex: 1;
  overflow: hidden;
}


.sidebar {
  width: 220px;
  background: #f5f5f5;
  display: flex;
  flex-direction: column;
  padding: 20px 0;
  box-shadow: 2px 0 5px rgba(0,0,0,0.05);
}

.nav-link {
  padding: 12px 20px;
  text-decoration: none;
  color: #333;
  font-weight: 500;
  transition: all 0.2s;
}

.nav-link:hover {
  background: #1976d2;
  color: #fff;
}

.nav-link.active {
  background: #1976d2;
  color: #fff;
}


.main-content {
  flex: 1;
  padding: 20px;
  overflow-y: auto;
  background: #f0f2f5;
}


.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}

@media (max-width: 768px) {
  .body {
    flex-direction: column;
  }

  .sidebar {
    width: 100%;
    flex-direction: row;
    overflow-x: auto;
  }

  .nav-link {
    padding: 10px;
    flex: 1;
    text-align: center;
  }
}
</style>
