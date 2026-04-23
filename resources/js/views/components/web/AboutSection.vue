<template>
  <v-container id="about" fluid class="py-16 position-relative overflow-hidden bg-background">
    <div class="shape-blob shape-primary"></div>
    <div class="shape-blob shape-danger"></div>

    <v-container>
      <v-row align="center" justify="center">
        <v-col cols="12" md="5" class="position-relative d-flex justify-center">
          <div class="image-wrapper">
            <v-card class="profile-card" border="border" elevation="0">
              <v-img :src="globalStore.getSetting('image') || profileImg" alt="Profile Image" cover class="rounded-lg">
                <div class="image-overlay"></div>
              </v-img>
            </v-card>
            <div class="decorative-box bg-primary"></div>
          </div>
        </v-col>  

        <v-col cols="12" md="7" class="pl-md-12">
          <div class="content-box">
            <span class="text-primary font-weight-bold text-uppercase letter-spacing-2">
              Discover My Journey
            </span>
            
            <h2 class="text-h3 font-weight-black text-white mt-2 mb-4">
              I'm <span class="text-primary">{{ globalStore.getSetting('name') || 'Muhammad Shakeeb Raza' }}</span>
            </h2>
            
            <h3 class="text-h5 font-weight-medium text-danger mb-6">
              {{ globalStore.getSetting('designation') || 'Full-Stack Developer | Laravel & Vue.js' }}
            </h3>

            <v-divider class="mb-6" style="opacity: 0.1;"></v-divider>

            <p class="text-body-1 text-light_text_on mb-8 leading-relaxed">
               {{ globalStore.getSetting('detail_dsc') }}
            </p>

            <v-row class="mb-8">
              <v-col cols="6" sm="4">
                <div class="stat-item">
                  <div class="text-h4 font-weight-bold text-primary">{{ globalStore.getSetting('exp_years') || '3+' }}</div>
                  <div class="text-caption text-light_text_on">Years Exp.</div>
                </div>
              </v-col>
              <v-col cols="6" sm="4">
                <div class="stat-item">
                  <div class="text-h4 font-weight-bold text-primary">{{ globalStore.getSetting('projects_count') || '20+' }}</div>
                  <div class="text-caption text-light_text_on">Projects Done</div>
                </div>
              </v-col>
            </v-row>
            
            <div class="d-flex flex-wrap gap-2">
              <v-chip v-for="(skill, index) in dynamicSkills" :key="index"
                :color="getRandomColor()"
                variant="tonal"
                class="font-weight-bold"
                size="small"
              >
                {{ skill.trim() }}
              </v-chip>
            </div>
            
            <div class="mt-10 d-flex align-center gap-4">
              <v-btn to="/contact" color="primary" size="large" rounded="lg" class="px-8 font-weight-bold shadow-primary">
                Contact us
              </v-btn>
              <v-btn variant="text" color="white" prepend-icon="mdi-play-circle-outline">
                Watch Portfolio
              </v-btn>
            </div>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </v-container>
</template>

<script>
  import profileImg from "@/assets/profile.jpeg";
  import { useGlobalSettingStore } from '@/stores/globalSetting'
  
  export default {
    data(){
      return {
        globalStore: useGlobalSettingStore(),
        profileImg: profileImg,
        chipColors: ['primary', 'secondary', 'info', 'success', 'warning', 'error', 'orange', 'purple', 'cyan']
      };
    },
    
    computed: {
      dynamicSkills() {
        const skillsString = this.globalStore.getSetting('skills'); 
        return skillsString ? skillsString.split(',') : [];
      }
    },

    async mounted() {
      await this.globalStore.loadSettings()
    },

    methods: {
      getRandomColor() {
        return this.chipColors[Math.floor(Math.random() * this.chipColors.length)];
      },

      downloadCV() {
        const cvPath = this.globalStore.getSetting('cv_url');
        if (cvPath) {
          const link = document.createElement('a');
          link.href = cvPath;
          link.setAttribute('download', 'Muhammad_shakeeb_raza.pdf');
          link.setAttribute('target', '_blank');
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
        }
      }
    }
  };  
</script>

<style scoped>
.letter-spacing-2 { letter-spacing: 2px; }
.leading-relaxed { line-height: 1.8 !important; }
.gap-4 { gap: 16px; }
.gap-2 { gap: 8px; }


.image-wrapper {
  position: relative;
  z-index: 2;
}

.profile-card {
  width: 320px;
  background: #021830 !important; /* Aapka inputBg color */
  padding: 12px;
  border-radius: 24px !important;
  z-index: 2;
}

.image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom, transparent 60%, rgba(0, 14, 32, 0.8));
}

.decorative-box {
  position: absolute;
  width: 100px;
  height: 100px;
  bottom: -20px;
  left: -20px;
  border-radius: 16px;
  z-index: 1;
  opacity: 0.3;
}


.shape-blob {
  position: absolute;
  border-radius: 50%;
  filter: blur(100px);
  opacity: 0.15;
  z-index: 0;
}

.shape-primary {
  width: 500px;
  height: 500px;
  background: #0080FF; 
  top: -10%;
  right: -10%;
}

.shape-danger {
  width: 400px;
  height: 400px;
  background: #f21202;
  bottom: -10%;
  left: -10%;
}

.stat-item {
  border-left: 3px solid #0080FF;
  padding-left: 15px;
}

.shadow-primary {
  box-shadow: 0 10px 20px rgba(0, 128, 255, 0.3) !important;
}
</style>