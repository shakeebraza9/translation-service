<template>
  <v-container fluid class="bg-background min-h-screen d-flex align-center justify-center pa-4">
    <v-row justify="center" align="center">
      <v-col cols="12" md="8" lg="6" class="text-center">
        
        <!-- Big 404 Number -->
        <div class="mb-6">
          <h1 class="text-404 font-weight-black text-white">404</h1>
        </div>

        <!-- Message -->
        <h2 class="text-h4 font-weight-bold text-white mb-3">
          Oops! Page Not Found
        </h2>
        
        <p class="text-light_text_on text-body-1 mb-8 max-w-400 mx-auto">
          Sorry, the page you're looking for doesn't exist or has been moved.
        </p>

        <!-- Illustration / Emoji -->
        <div class="mb-10">
          <v-icon size="120" color="primary" class="mb-4">mdi-compass-off</v-icon>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex flex-column flex-sm-row gap-4 justify-center">


          <v-btn
            @click="goBack"
            variant="outlined"
            color="grey-lighten-2"
            size="large"
            rounded="pill"
            class="font-weight-medium px-8"
          >
            Go Back
          </v-btn>
        </div>

        <!-- Extra Help -->
        <p class="text-caption text-light_text_on mt-12">
          If you believe this is an error, please contact support
        </p>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()

const goBack = () => {
  router.go(-1)
}
</script>

<style scoped>
.text-404 {
  font-size: 12rem;
  line-height: 1;
  letter-spacing: -0.05em;
  opacity: 0.9;
  color: #0080FF;
  text-shadow: 0 10px 30px rgba(0, 128, 255, 0.3);
}

.max-w-400 {
  max-width: 400px;
}

.min-h-screen {
  min-height: 100vh;
}

/* Responsive */
@media (max-width: 600px) {
  .text-404 {
    font-size: 8rem;
  }
}
</style>