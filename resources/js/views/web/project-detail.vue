<template>
  <v-container fluid class="pa-0 bg-background min-h-screen">
    
    <v-sheet height="100vh" color="#05070a" class="d-flex align-center position-relative overflow-hidden">
      <div class="glow-orb-top"></div>
      <v-container>
        <v-row align="center">
          <v-col cols="12" md="7">
            <v-btn variant="text" color="primary" prepend-icon="mdi-arrow-left" class="mb-8 blur-btn" @click="$router.back()">
              Portfolio
            </v-btn>
            <h1 class="display-title mb-4">AUTOBILI <span class="gradient-text">LTD</span></h1>
            <p class="text-h5 text-grey-lighten-1 mb-10 max-w-600 font-weight-light">
              A high-performance scraping engine that automates UK automotive auctions with precision and speed.
            </p>
            
            <div class="d-flex flex-wrap gap-4 mb-12">
              <v-btn size="x-large" color="primary" elevation="12" class="px-8 rounded-pill font-weight-bold" prepend-icon="mdi-rocket-launch" href="#" target="_blank">
                Live Preview
              </v-btn>
              <v-btn size="x-large" variant="outlined" color="white" class="px-8 rounded-pill font-weight-bold blur-btn" prepend-icon="mdi-github" href="#" target="_blank">
                Source Code
              </v-btn>
            </div>

            <div class="d-flex flex-wrap gap-3">
              <v-chip v-for="tag in ['Laravel 11', 'Vue 3', 'Selenium', 'PostgreSQL']" :key="tag" 
                variant="outlined" color="primary" class="text-uppercase font-weight-bold px-4">
                {{ tag }}
              </v-chip>
            </div>
          </v-col>
          
          <v-col cols="12" md="5" class="d-none d-md-block">
            <div class="hero-visual-card">
              <div class="floating-code-card">
                <v-icon color="primary" class="mr-2">mdi-xml</v-icon>
                <span class="text-caption text-grey">Scraper.py running...</span>
              </div>
              <v-img src="https://images.unsplash.com/photo-1614064641938-3bbee52942c7?q=80&w=2070" cover class="rounded-xl border-accent"></v-img>
            </div>
          </v-col>
        </v-row>
      </v-container>
      <div class="scroll-down">
        <v-icon color="primary" class="animate-bounce">mdi-chevron-down</v-icon>
      </div>
    </v-sheet>

    <v-container class="py-16">
      <v-row>
        <v-col cols="12" lg="8">
          <section class="mb-16">
            <h2 class="text-h3 font-weight-bold text-white mb-8 border-l-4 border-primary pl-6">Technical Concept</h2>
            <p class="text-body-1 text-grey-lighten-2 line-height-2 mb-8 pr-lg-10">
              Manual auction monitoring mein dealers ko kaafi loss ho raha tha. **AUTOBILI LTD** ne isay solve kiya by implementing a 
              **headless browser architecture**. Humne customized scrapers develop kiye jo background job queues ke zariye data 
              fetch karte hain aur user ko notification bhejte hain jab koi "Hot Deal" milti hai.
            </p>
            
            <v-row class="mt-8">
              <v-col cols="12" sm="6" v-for="feat in features" :key="feat.title">
                <v-card border color="#0d1117" class="pa-8 rounded-xl h-100 feature-card shadow-lg">
                  <v-avatar color="rgba(0,128,255,0.1)" size="60" class="mb-6">
                    <v-icon color="primary" size="30">{{ feat.icon }}</v-icon>
                  </v-avatar>
                  <h4 class="text-h6 text-white mb-3">{{ feat.title }}</h4>
                  <p class="text-body-2 text-grey-lighten-1">{{ feat.desc }}</p>
                </v-card>
              </v-col>
            </v-row>
          </section>
        </v-col>

        <v-col cols="12" lg="4">
          <v-card border color="#0d1117" class="pa-8 rounded-xl sticky-info">
            <h3 class="text-h6 text-white mb-6 font-weight-bold">Project Architecture</h3>
            
            <div class="mb-6">
              <div class="d-flex justify-space-between mb-2">
                <span class="text-grey-darken-1">Framework</span>
                <span class="text-white">Laravel 11 / Vue 3</span>
              </div>
              <v-progress-linear color="primary" model-value="95" height="4" rounded></v-progress-linear>
            </div>

            <div class="mb-6">
              <div class="d-flex justify-space-between mb-2">
                <span class="text-grey-darken-1">Database</span>
                <span class="text-white">PostgreSQL</span>
              </div>
              <v-progress-linear color="primary" model-value="88" height="4" rounded></v-progress-linear>
            </div>

            <v-divider class="my-6 border-opacity-25"></v-divider>
            
            <div class="d-flex align-center mb-4">
              <v-icon color="grey" class="mr-3">mdi-calendar-check</v-icon>
              <div>
                <div class="text-caption text-grey">Completed</div>
                <div class="text-white font-weight-bold">March 2026</div>
              </div>
            </div>

            <v-btn block color="white" variant="outlined" height="50" class="mt-8 font-weight-bold rounded-lg" prepend-icon="mdi-email-outline">
              Hire for Similar Project
            </v-btn>
          </v-card>
        </v-col>
      </v-row>
    </v-container>

    <v-sheet color="#05070a" class="py-16 border-t border-primary-darken-4">
      <v-container>
        <div class="text-center mb-16">
          <v-chip color="primary" variant="tonal" class="mb-4">PREVIEW MODE</v-chip>
          <h2 class="text-h2 font-weight-black text-white">Full <span class="text-primary">Experience</span></h2>
        </div>

        <v-row justify="center" class="mb-16">
          <v-col cols="12" md="10">
            <div class="video-wrapper">
              <v-hover v-slot="{ isHovering, props }">
                <v-card v-bind="props" border color="black" class="rounded-xl overflow-hidden" elevation="24">
                  <v-img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070" cover height="550" class="align-center justify-center">
                    <v-btn icon size="80" color="primary" class="play-btn-main" href="#" target="_blank">
                      <v-icon size="40">mdi-play</v-icon>
                    </v-btn>
                  </v-img>
                  <v-toolbar color="rgba(13, 17, 23, 0.9)" flat>
                    <v-toolbar-title class="text-subtitle-1 text-white font-weight-bold ml-4">
                      <v-icon start color="red" size="18">mdi-circle</v-icon> Backend Automation Demo
                    </v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-btn icon="mdi-share-variant" color="white"></v-btn>
                  </v-toolbar>
                </v-card>
              </v-hover>
            </div>
          </v-col>
        </v-row>

        <v-row>
          <v-col v-for="(img, i) in galleryImages" :key="i" cols="12" sm="4">
            <v-card class="gallery-card rounded-xl border-1" border @click="openGallery(i)">
              <v-img :src="img" cover height="280"></v-img>
              <div class="gallery-overlay">
                <v-icon color="white" size="40">mdi-plus</v-icon>
                <span class="text-white mt-2 font-weight-bold">View Full</span>
              </div>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-sheet>

    <v-dialog v-model="dialog" max-width="85vw">
      <v-card color="#0d1117" border class="pa-2">
        <v-btn icon="mdi-close" color="primary" position="absolute" style="top: 10px; right: 10px; z-index: 10;" @click="dialog = false"></v-btn>
        <v-img :src="galleryImages[selectedImg]" contain max-height="80vh"></v-img>
      </v-card>
    </v-dialog>

  </v-container>
</template>

<script setup>
import { ref } from 'vue';

const dialog = ref(false);
const selectedImg = ref(0);

const features = [
  { title: 'Selenium Automation', icon: 'mdi-robot-industrial', desc: 'Custom drivers for handling dynamic content and multi-step logins.' },
  { title: 'Real-time Webhook', icon: 'mdi-lightning-bolt', desc: 'Instant notifications pushed to user dashboard via Socket.io.' },
  { title: 'Stripe Integration', icon: 'mdi-credit-card-outline', desc: 'Automated subscription management and billing system.' },
  { title: 'Data Encryption', icon: 'mdi-lock-check', desc: 'End-to-end encryption for sensitive auction access credentials.' }
];

const galleryImages = [
  'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2026',
  'https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=2070',
  'https://images.unsplash.com/photo-1504868584819-f8e90526ef7d?q=80&w=2070'
];

const openGallery = (i) => { selectedImg.value = i; dialog.value = true; };
</script>

<style scoped>
/* Main Styles */
.display-title { font-size: clamp(3rem, 10vw, 5.5rem); line-height: 1; font-weight: 900; letter-spacing: -3px; }
.gradient-text { background: linear-gradient(90deg, #0080ff, #4facfe); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
.line-height-2 { line-height: 1.8; letter-spacing: 0.3px; }

/* Visual Components */
.hero-visual-card { position: relative; perspective: 1000px; }
.border-accent { border: 1px solid rgba(0, 128, 255, 0.3) !important; box-shadow: 0 20px 50px rgba(0,0,0,0.5); }
.floating-code-card {
  position: absolute; top: 20px; left: -30px; background: rgba(13, 17, 23, 0.85);
  backdrop-filter: blur(10px); padding: 12px 20px; border-radius: 12px;
  border: 1px solid rgba(255,255,255,0.1); z-index: 2; animation: float 4s ease-in-out infinite;
}

@keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }

/* Buttons & Chips */
.blur-btn { background: rgba(255,255,255,0.03); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.1) !important; }

/* Feature Cards */
.feature-card { transition: all 0.3s ease; }
.feature-card:hover { transform: translateY(-10px); border-color: #0080ff !important; box-shadow: 0 15px 30px rgba(0, 128, 255, 0.1) !important; }

/* Video & Gallery */
.video-wrapper { position: relative; border: 1px solid rgba(0, 128, 255, 0.2); border-radius: 24px; padding: 10px; }
.play-btn-main { animation: pulse-blue 2s infinite; }
@keyframes pulse-blue { 0% { box-shadow: 0 0 0 0 rgba(0, 128, 255, 0.4); } 70% { box-shadow: 0 0 0 30px rgba(0, 128, 255, 0); } 100% { box-shadow: 0 0 0 0 rgba(0, 128, 255, 0); } }

.gallery-card { position: relative; cursor: pointer; border: 1px solid rgba(255,255,255,0.05); }
.gallery-overlay {
  position: absolute; inset: 0; background: rgba(0, 128, 255, 0.9);
  display: flex; flex-direction: column; align-items: center; justify-content: center;
  opacity: 0; transition: 0.4s ease;
}
.gallery-card:hover .gallery-overlay { opacity: 1; }

.sticky-info { position: sticky; top: 100px; z-index: 10; }
.glow-orb-top {
  position: absolute; top: -10%; left: -5%; width: 40vw; height: 40vw;
  background: radial-gradient(circle, rgba(0, 128, 255, 0.1) 0%, transparent 70%);
  filter: blur(100px);
}
</style>