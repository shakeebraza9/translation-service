<template>
  <v-container id="projects" fluid class="py-16 bg-background position-relative">
    <div class="projects-glow"></div>

    <v-container>
      <v-row class="mb-10" align="center">
        <v-col cols="12" md="6">
          <span class="text-primary font-weight-bold text-uppercase letter-spacing-2">My Portfolio</span>
          <h2 class="text-h3 font-weight-black text-white mt-2">Latest <span class="text-primary">Projects</span></h2>
          <p class="text-light_text_on mt-4">
            Kuch aise projects jo maine Laravel, Vue.js aur Python (Web Scraping) use karke build kiye hain.
          </p>
        </v-col>
        
        <v-col cols="12" md="6" class="d-flex justify-md-end">
          <v-tabs
            v-model="activeTab"
            bg-color="transparent"
            color="primary"
            class="filter-tabs"
            density="comfortable"
          >
            <v-tab value="all" class="text-none">All</v-tab>
            <v-tab value="Laravel" class="text-none">Laravel</v-tab>
            <v-tab value="Vue" class="text-none">Vue.js</v-tab>
            <v-tab value="Scraping" class="text-none">Scraping</v-tab>
          </v-tabs>
        </v-col>
      </v-row>

      <v-row>
        <v-col 
          v-for="project in filteredProjects" 
          :key="project.id" 
          cols="12" md="4" sm="6"
          class="project-col"
        >
          <v-hover v-slot="{ isHovering, props }">
            <v-card 
              v-bind="props"
              class="project-card h-full" 
              :elevation="isHovering ? 12 : 2"
              border="border"
              color="surface"
            >
              <div class="image-container">
                <v-img 
                  :src="project.image" 
                  height="250" 
                  cover
                  :class="{ 'zoom-effect': isHovering }"
                >
                  <v-fade-transition grow>
                    <div v-if="isHovering" class="d-flex align-center justify-center fill-height bg-primary-darken-4-opacity-80">
                      <v-btn color="white" variant="outlined" rounded="pill" class="mx-2">Details</v-btn>
                      <v-btn color="white" icon="mdi-launch" variant="flat" :href="project.link" target="_blank"></v-btn>
                    </div>
                  </v-fade-transition>
                </v-img>
              </div>

              <v-card-text class="pa-6">
                <div class="mb-3">
                  <v-chip 
                    v-for="tag in project.tags" 
                    :key="tag"
                    size="x-small" 
                    variant="tonal" 
                    color="primary" 
                    class="mr-1 mb-1 font-weight-bold"
                  >
                    {{ tag }}
                  </v-chip>
                </div>

                <h3 class="text-h5 font-weight-bold text-white mb-2">{{ project.title }}</h3>
                <p class="text-light_text_on text-body-2 line-clamp-3">
                  {{ project.description }}
                </p>
              </v-card-text>

              <v-spacer></v-spacer>

              <v-divider style="opacity: 0.1"></v-divider>

              <v-card-actions class="pa-4">
                <v-btn icon="mdi-github" variant="text" color="white" :href="project.github"></v-btn>
                <v-spacer></v-spacer>
                <v-btn variant="text" color="primary" append-icon="mdi-arrow-right" class="font-weight-bold">
                  View Case
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-hover>
        </v-col>
      </v-row>
    </v-container>
  </v-container>
</template>

<script setup>
import { ref, computed } from 'vue';

const activeTab = ref('all');

const projects = [
  {
    id: 1,
    title: 'AUTOBILI LTD',
    category: 'Scraping',
    tags: ['Laravel', 'Vue 3', 'Selenium'],
    description: 'Automotive auction scraping platform with real-time data sync, secure payment integration, and custom blog management.',
    image: 'https://via.placeholder.com/400x250/0E1B2B/ffffff?text=Autobili+LTD',
    github: '#',
    link: '#'
  },
  {
    id: 2,
    title: 'Electrum BTC Wallet',
    category: 'Laravel',
    tags: ['Laravel', 'Python', 'Electrum API'],
    description: 'Integrated a secure Electrum wallet system for automated Bitcoin transactions and monitoring on e-commerce platforms.',
    image: 'https://via.placeholder.com/400x250/0E1B2B/ffffff?text=Crypto+Wallet',
    github: '#',
    link: '#'
  },
  {
    id: 3,
    title: 'Portfolio Dashboard',
    category: 'Vue',
    tags: ['Vue 3', 'Pinia', 'Vuetify'],
    description: 'A modern, high-performance admin dashboard built with Vue 3 and Pinia for personal brand management.',
    image: 'https://via.placeholder.com/400x250/0E1B2B/ffffff?text=Admin+Dashboard',
    github: '#',
    link: '#'
  }
];

const filteredProjects = computed(() => {
  if (activeTab.ref === 'all' || activeTab.value === 'all') return projects;
  return projects.filter(p => p.category === activeTab.value || p.tags.includes(activeTab.value));
});
</script>

<style scoped>
.letter-spacing-2 { letter-spacing: 2px; }
.bg-primary-darken-4-opacity-80 { background: rgba(0, 128, 255, 0.85); }

.project-card {
  transition: transform 0.3s ease;
  border-radius: 20px !important;
  display: flex;
  flex-direction: column;
}

.image-container {
  overflow: hidden;
  border-radius: 20px 20px 0 0;
}

.zoom-effect {
  transform: scale(1.1);
  transition: transform 0.5s ease;
}

.projects-glow {
  position: absolute;
  top: 20%;
  left: -10%;
  width: 400px;
  height: 400px;
  background: radial-gradient(circle, rgba(0, 128, 255, 0.1) 0%, transparent 70%);
  pointer-events: none;
}

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;  
  overflow: hidden;
}

.filter-tabs :deep(.v-btn) {
  font-weight: bold !important;
}
</style>