<template>
  <v-sheet 
    height="750" 
    class="hero-wrapper d-flex flex-column align-center justify-center text-center px-4 overflow-hidden position-relative bg-surface"
  >
    <div class="mesh-gradient"></div>
    <div class="glow-circle shape-1"></div>
    <div class="glow-circle shape-2"></div>

    <v-container class="content-z-index pa-0" fluid>
      <v-fade-transition grow appear>
        <v-row align="center" justify="center" class="hero-content mx-0">
          
          <v-col cols="12" md="5" class="d-flex justify-center mb-10 mb-md-0 position-relative">
            <div class="avatar-container">
              <v-avatar size="280" color="#0E1B2B" class="avatar-pulse-outline shadow-primary">
                <v-img 
                  :src="avatarImage" 
                  alt="Ajoy Sarker"
                  cover
                  class="rounded-pill"
                >
                  <template v-slot:placeholder>
                    <v-row class="fill-height ma-0" align="center" justify="center">
                      <v-progress-circular indeterminate color="primary"></v-progress-circular>
                    </v-row>
                  </template>
                </v-img>
              </v-avatar>
              
              <div class="floating-badge d-flex align-center">
                <v-icon color="success" size="16">mdi-circle</v-icon>
                <span class="text-caption text-white ml-2 font-weight-bold">Available Now</span>
              </div>
            </div>
          </v-col>

          <v-col cols="12" md="7" class="text-left-md text-center-sm pl-md-10">
            <div>
              <span class="text-subtitle-1 text-primary font-weight-bold text-uppercase letter-spacing-2">
                Discover My Journey
              </span>
              
              <h1 class="text-h2 font-weight-black mb-4 text-white">
                I'm <span class="text-primary">Muhammad Shakeeb Raza</span>
              </h1>
              
              <h3 class="text-h5 font-weight-medium text-danger mb-8 leading-relaxed">
                Full-Stack Developer Specializing in Laravel & Vue.js Ecosystem. 
              </h3>
              
              <p class="text-body-1 text-light_text_on mb-10 max-w-600 mx-auto mx-md-0">
               I am a passionate developer committed to building complex web applications that are simple and scalable. My top priorities are clean code and user-centric design.
              </p>

              <div class="d-flex flex-wrap justify-center justify-md-start gap-4">
                <v-btn 
                  color="primary" 
                  size="x-large" 
                  rounded="pill" 
                  elevation="12" 
                  prepend-icon="mdi-download"
                  class="px-10 font-weight-bold shadow-primary"
                >
                  Download CV
                </v-btn>
                
                <v-btn 
                  variant="outlined" 
                  color="white" 
                  size="x-large" 
                  rounded="pill"
                  to="/contact"
                  class="px-10 font-weight-bold border-white-op"
                >
                  Contact Me
                </v-btn>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-fade-transition>
    </v-container>
  </v-sheet>
</template>

<script setup>
import avatarImage from '@/assets/avatar.png'; // Aapka avatar image path
</script>

<style scoped>
.min-vh-100 { min-height: 100vh; }
.letter-spacing-2 { letter-spacing: 2px; }
.z-index-2 { z-index: 2; }
.leading-relaxed { line-height: 1.6 !important; }
.max-w-600 { max-width: 600px; }
.gap-4 { gap: 16px; }

.hero-wrapper {
  background: #000E20 !important; /* Theme Surface Color */
}

.mesh-gradient {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: 
    radial-gradient(at 0% 0%, rgba(0, 128, 255, 0.1) 0, transparent 50%), 
    radial-gradient(at 100% 100%, rgba(242, 18, 2, 0.05) 0, transparent 50%); /* Mixed with Danger Hint */
  z-index: 1;
}

.content-z-index {
  position: relative;
  z-index: 5;
}

.glow-circle {
  position: absolute;
  border-radius: 50%;
  filter: blur(100px);
  z-index: 2;
  opacity: 0.3;
  animation: mesh-move 20s infinite alternate ease-in-out;
}

.shape-1 {
  width: 500px;
  height: 500px;
  background: #0080FF; /* Primary */
  top: -150px;
  right: -100px;
}

.shape-2 {
  width: 450px;
  height: 450px;
  background: #f21202; /* Danger color from your theme for contrast */
  bottom: -150px;
  left: -100px;
  animation-delay: -7s;
}

@keyframes mesh-move {
  0% { transform: translate(0, 0) scale(1); }
  100% { transform: translate(120px, 80px) scale(1.2); }
}

/* Avatar Specific Styling */
.avatar-container {
  position: relative;
  z-index: 3;
}

.avatar-pulse-outline {
  position: relative;
  border: 10px solid #000E20 !important; /* Theme Surface Color */
}

/* Moving Outline Effect */
.avatar-pulse-outline::before {
  content: "";
  position: absolute;
  top: -10px;
  left: -10px;
  right: -10px;
  bottom: -10px;
  border: 3px solid #0080FF; /* Primary */
  border-radius: 50%;
  opacity: 0.8;
  animation: avatar-pulse 2s infinite cubic-bezier(0.165, 0.84, 0.44, 1);
}

@keyframes avatar-pulse {
  0% { transform: scale(1); opacity: 0.8; }
  100% { transform: scale(1.15); opacity: 0; }
}

.shadow-primary {
  box-shadow: 0 20px 50px rgba(0, 128, 255, 0.4) !important;
}

.floating-badge {
  position: absolute;
  bottom: -10px;
  right: -20px;
  background: #021830; /* Theme InputBg Color */
  padding: 8px 16px;
  border-radius: 30px;
  border: 2px solid #343E4B; /* Theme Border Color */
  z-index: 4;
}

.text-left-md {
  text-align: left;
}

.text-center-sm {
  @media (max-width: 960px) {
    text-align: center;
  }
}
</style>