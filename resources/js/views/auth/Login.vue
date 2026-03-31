<template>
  <v-container fluid class="login-wrapper d-flex align-center justify-center fill-height position-relative overflow-hidden">
    <div class="mesh-gradient"></div>
    <div class="glow-circle shape-1"></div>
    <div class="glow-circle shape-2"></div>

    <v-row justify="center" class="content-z-index w-100">
      <v-col cols="12" sm="8" md="5" lg="4">
        
        <div class="text-center mb-8">
          <router-link to="/" class="text-decoration-none">
            <h1 class="text-h4 font-weight-black text-white">
              <span class="text-primary">Shakeeb</span>.DEV
            </h1>
          </router-link>
          <p class="text-light_text_on mt-2">Welcome back! Please login to your account.</p>
        </div>

        <v-card class="login-card pa-8" border="border" elevation="24">
          <v-form @submit.prevent="submit">
            
            <v-alert
              v-if="error"
              type="error"
              variant="tonal"
              closable
              class="mb-6 rounded-lg"
              density="compact"
            >
              {{ error }}
            </v-alert>

            <div class="text-subtitle-2 text-white mb-2 ml-1">Email Address</div>
            <v-text-field
              v-model="form.email"
              placeholder="name@example.com"
              prepend-inner-icon="mdi-email-outline"
              variant="outlined"
              color="primary"
              bg-color="inputBg"
              :disabled="loading"
              persistent-placeholder
              class="mb-4 custom-input"
            ></v-text-field>

            <div class="text-subtitle-2 text-white mb-2 ml-1">Password</div>
            <v-text-field
              v-model="form.password"
              placeholder="••••••••"
              prepend-inner-icon="mdi-lock-outline"
              :type="showPassword ? 'text' : 'password'"
              :append-inner-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
              @click:append-inner="showPassword = !showPassword"
              variant="outlined"
              color="primary"
              bg-color="inputBg"
              :disabled="loading"
              persistent-placeholder
              class="mb-2 custom-input"
            ></v-text-field>

            <div class="d-flex align-center justify-end mb-6">
              <a href="#" class="text-caption text-primary font-weight-bold text-decoration-none">Forgot Password?</a>
            </div>

            <v-btn
              type="submit"
              color="primary"
              block
              size="x-large"
              rounded="lg"
              class="font-weight-bold text-capitalize mt-4"
              :loading="loading"
              elevation="8"
            >
              Sign In
              <template v-slot:loader>
                <v-progress-circular indeterminate size="22" width="2"></v-progress-circular>
              </template>
            </v-btn>
          </v-form>

          <div class="text-center mt-8">
            <span class="text-grey-darken-1 text-body-2">Not an admin?</span>
            <v-btn to="/" variant="text" color="primary" class="text-none font-weight-bold ml-1 px-1">
              Go back home
            </v-btn>
          </div>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useUserStore } from '@/stores/userStore'

const router = useRouter()
const userStore = useUserStore()

const showPassword = ref(false)
const loading = ref(false)
const error = ref('')

const form = ref({
  email: 'shakeeb@gmail.com',
  password: '123456789',
})

const submit = async () => {
  error.value = ''
  loading.value = true

  try {
    await userStore.login(form.value)
    // Aapke router logic ke mutabiq redirect
    router.push('/admin/dashboard') 
  } catch (e) {
    error.value = e.response?.data?.message || 'Invalid credentials'
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
.login-wrapper {
  background: #000E20 !important; 
  min-height: 100vh;
}

.login-card {
  background: rgba(2, 24, 48, 0.7) !important;
  backdrop-filter: blur(15px);
  border-radius: 24px !important;
  border: 1px solid rgba(52, 62, 75, 0.5) !important;
}

.custom-input :deep(.v-field) {
  border-radius: 12px !important;
}


.mesh-gradient {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: 
    radial-gradient(at 0% 0%, rgba(0, 128, 255, 0.1) 0, transparent 50%), 
    radial-gradient(at 100% 100%, rgba(242, 18, 2, 0.05) 0, transparent 50%);
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
  opacity: 0.2;
  animation: mesh-move 20s infinite alternate ease-in-out;
}

.shape-1 {
  width: 600px;
  height: 600px;
  background: #0080FF;
  top: -200px;
  right: -100px;
}

.shape-2 {
  width: 500px;
  height: 500px;
  background: #f21202;
  bottom: -150px;
  left: -100px;
  animation-delay: -7s;
}

@keyframes mesh-move {
  0% { transform: translate(0, 0) scale(1); }
  100% { transform: translate(50px, 50px) scale(1.1); }
}
</style>