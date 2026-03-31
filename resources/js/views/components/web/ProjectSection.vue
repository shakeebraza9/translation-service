<template>
  <v-container id="projects" fluid class="py-16 bg-background position-relative">
    <div class="decor-line"></div>

    <v-container>
      <div class="d-flex align-center mb-12">
        <div>
          <span class="text-primary font-weight-bold text-uppercase">Portfolio Showcase</span>
          <h2 class="text-h3 font-weight-black text-white">Latest <span class="text-primary">Works</span></h2>
        </div>
        <v-spacer></v-spacer>
        <v-btn :to="'/projects'" variant="outlined" color="primary" rounded="lg" class="hidden-sm-and-down">
          View All Projects
        </v-btn>
      </div>

      <v-row>
        <v-col 
          v-for="project in projects" 
          :key="project.id" 
          cols="12" md="4" sm="6"
        >
          <v-card 
            class="project-card h-full" 
            border="border"
            color="surface"
          >
            <div class="image-container">
              <v-img 
                :src="project.image" 
                height="240" 
                cover
                class="project-img"
              >
                <template v-slot:placeholder>
                  <v-row class="fill-height ma-0" align="center" justify="center">
                    <v-progress-circular indeterminate color="primary"></v-progress-circular>
                  </v-row>
                </template>
                
                <div class="image-overlay d-flex align-center justify-center">
                  <v-btn color="white" variant="flat" rounded="pill" class="mx-2">View Case</v-btn>
                </div>
              </v-img>
            </div>

            <v-card-text class="pa-6">
              <div class="d-flex flex-wrap gap-2 mb-4">
                <v-chip 
                  v-for="tech in project.tags" 
                  :key="tech"
                  size="x-small" 
                  variant="tonal" 
                  color="primary"
                  class="font-weight-bold"
                >
                  {{ tech }}
                </v-chip>
              </div>

              <h3 class="text-h5 font-weight-bold text-white mb-2">{{ project.title }}</h3>
              <p class="text-light_text_on text-body-2 line-clamp-3">
                {{ project.description }}
              </p>
            </v-card-text>

            <v-divider style="opacity: 0.05"></v-divider>

            <v-card-actions class="pa-4 bg-surface-variant-1">
              <v-btn 
                icon="mdi-github" 
                variant="text" 
                color="white"
                :href="project.github"
              ></v-btn>
              <v-btn 
                icon="mdi-link-variant" 
                variant="text" 
                color="white"
                :href="project.link"
              ></v-btn>
              <v-spacer></v-spacer>
              <v-btn 
                variant="text" 
                color="primary" 
                append-icon="mdi-arrow-right"
                class="font-weight-bold"
              >
                Details
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-container>
</template>

<script setup>
const projects = [
  {
    id: 1,
    title: 'AUTOBILI LTD',
    tags: ['Laravel', 'Vue 3', 'Selenium'],
    description: 'A professional automotive auction scraping platform with real-time data synchronization and advanced filtering.',
    image: 'https://via.placeholder.com/400x240/0E1B2B/ffffff?text=Autobili+LTD',
    github: '#',
    link: '#'
  },
  {
    id: 2,
    title: 'Electrum Crypto Integration',
    tags: ['Python', 'Vue.js', 'Blockchain'],
    description: 'Secure Electrum wallet integration for automated BTC payments and transaction monitoring for web apps.',
    image: 'https://via.placeholder.com/400x240/0E1B2B/ffffff?text=Crypto+Wallet',
    github: '#',
    link: '#'
  },
  {
    id: 3,
    title: 'Smart Invoice System',
    tags: ['Laravel', 'Stripe', 'PDF.js'],
    description: 'Automated billing system with PDF generation and Stripe payment gateway integration.',
    image: 'https://via.placeholder.com/400x240/0E1B2B/ffffff?text=Billing+System',
    github: '#',
    link: '#'
  }
];
</script>

<style scoped>
.project-card {
  transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
  overflow: hidden;
  border-radius: 20px !important;
  border: 1px solid rgba(52, 62, 75, 0.5) !important;
}

.project-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4) !important;
  border-color: #0080FF !important;
}

.image-container {
  overflow: hidden;
  position: relative;
}

.project-img {
  transition: transform 0.6s ease;
}

.project-card:hover .project-img {
  transform: scale(1.1);
}

.image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 128, 255, 0.6);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.project-card:hover .image-overlay {
  opacity: 1;
}

.gap-2 { gap: 8px; }

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;  
  overflow: hidden;
}

.decor-line {
  position: absolute;
  top: 10%;
  right: 0;
  width: 300px;
  height: 2px;
  background: linear-gradient(to left, #0080FF, transparent);
  opacity: 0.2;
}
</style>