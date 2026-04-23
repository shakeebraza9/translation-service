<template>
  <v-app-bar 
    flat 
    border 
    class="px-md-10" 
    color="surface"
    sticky
  >
    <v-app-bar-title class="font-weight-black text-white">
      <span class="text-primary">{{ globalStore.getSetting('website_name') || 'Shakeeb' }}</span>.DEV
    </v-app-bar-title>

    <v-spacer></v-spacer>

    <div class="hidden-sm-and-down d-flex align-center h-full mr-6">
      <router-link 
        v-for="link in navLinks" 
        :key="link.path"
        :to="link.path"
        custom
        v-slot="{ navigate, isActive }"
      >
        <div 
          @click="navigate"
          :class="['nav-item', { 'active-link': isActive }]"
        >
          {{ link.name }}
          <div class="underline"></div>
        </div>
      </router-link>
    </div>

    <v-divider vertical inset class="hidden-sm-and-down mx-4" style="opacity: 0.1"></v-divider>

    <div class="d-flex align-center gap-2">
      <v-btn icon="mdi-github" variant="text" color="white" href="#"></v-btn>
      <v-btn icon="mdi-linkedin" variant="text" color="primary" href="#"></v-btn>
    </div>

    <v-btn icon class="hidden-md-and-up ml-2" color="primary">
      <v-icon>mdi-menu</v-icon>
    </v-btn>
  </v-app-bar>
</template>

<script>
import { useGlobalSettingStore } from '@/stores/globalSetting'

export default {
  data() {
    return {
      globalStore: useGlobalSettingStore(),
      
      navLinks: [
        { name: 'Home', path: '/' },
        { name: 'Projects', path: '/projects' },
        { name: 'Blog', path: '/blog' },
        { name: 'Contact', path: '/contact' }
      ],
    };
  },

  async mounted() {
   await this.globalStore.loadSettings()
  },

  // methods: {

  // }
};
</script>



<style scoped>
.nav-item {
  position: relative;
  padding: 0 20px;
  height: 64px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: #B0B0B0; 
  font-weight: 500;
  text-transform: capitalize;
  transition: color 0.3s ease;
}

.nav-item:hover {
  color: #FFFFFF; 
}


.underline {
  position: absolute;
  bottom: 0;
  left: 50%;
  width: 0;
  height: 3px;
  background-color: #0080FF; 
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  transform: translateX(-50%);
  border-radius: 3px 3px 0 0;
}


.active-link {
  color: #0080FF !important; 
}

.active-link .underline {
  width: 70%; 
  box-shadow: 0 -2px 10px rgba(0, 128, 255, 0.3);
}

.gap-2 { gap: 8px; }
</style>