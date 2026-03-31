<template>
  <v-container id="contact" fluid class="py-16 bg-surface min-vh-100 position-relative overflow-hidden">
    <div class="contact-glow-1"></div>
    <div class="contact-glow-2"></div>

    <v-container class="position-relative z-index-2">
      <v-row justify="center">
        <v-col cols="12" md="5" class="pr-md-10 mb-10 mb-md-0">
          <span class="text-primary font-weight-bold text-uppercase letter-spacing-2">Get In Touch</span>
          <h2 class="text-h3 font-weight-black text-white mt-2 mb-6">
            Let's Build Something <span class="text-primary">Great</span>
          </h2>
          <p class="text-light_text_on mb-10 text-body-1">
            Agar aapke paas koi project idea hai ya aap mujhse full-stack development (Laravel/Vue) ke bare mein baat karna chahte hain, toh niche diye gaye form ya social links ke zariye rabta karein.
          </p>

          <div class="d-flex flex-column gap-6">
            <div class="d-flex align-center mb-6">
              <v-avatar color="primaryDark" size="56" class="mr-4">
                <v-icon color="white" size="28">mdi-email-outline</v-icon>
              </v-avatar>
              <div>
                <div class="text-caption text-primary font-weight-bold">Email Me</div>
                <div class="text-h6 text-white">shakeebraza90@gmail.com</div>
              </div>
            </div>

            <div class="d-flex align-center mb-6">
              <v-avatar color="primaryDark" size="56" class="mr-4">
                <v-icon color="white" size="28">mdi-map-marker-outline</v-icon>
              </v-avatar>
              <div>
                <div class="text-caption text-primary font-weight-bold">Location</div>
                <div class="text-h6 text-white">Karachi, Pakistan</div>
              </div>
            </div>
          </div>

          <div class="mt-10">
            <div class="text-subtitle-2 text-white mb-4">Follow My Work</div>
            <div class="d-flex gap-3">
              <v-btn icon="mdi-github" variant="tonal" color="white" class="mr-2"></v-btn>
              <v-btn icon="mdi-linkedin" variant="tonal" color="primary" class="mr-2"></v-btn>
              <v-btn icon="mdi-twitter" variant="tonal" color="info" class="mr-2"></v-btn>
            </div>
          </div>
        </v-col>

        <v-col cols="12" md="7">
          <v-card class="contact-form-card pa-8" border="border" elevation="0">
            <v-form @submit.prevent="submitForm">
              <v-row>
                <v-col cols="12" sm="6">
                  <v-text-field
                    label="Full Name"
                    variant="outlined"
                    color="primary"
                    bg-color="inputBg"
                    persistent-placeholder
                    placeholder="Ajoy Sarker"
                    hide-details="auto"
                    class="mb-4"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" sm="6">
                  <v-text-field
                    label="Email Address"
                    variant="outlined"
                    color="primary"
                    bg-color="inputBg"
                    persistent-placeholder
                    placeholder="email@example.com"
                    hide-details="auto"
                    class="mb-4"
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    label="Subject"
                    variant="outlined"
                    color="primary"
                    bg-color="inputBg"
                    hide-details="auto"
                    class="mb-4"
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-textarea
                    label="How can I help you?"
                    variant="outlined"
                    color="primary"
                    bg-color="inputBg"
                    rows="5"
                    hide-details="auto"
                    class="mb-6"
                  ></v-textarea>
                </v-col>
                <v-col cols="12">
                  <v-btn
                    block
                    color="primary"
                    size="x-large"
                    rounded="lg"
                    elevation="8"
                    class="font-weight-bold"
                    prepend-icon="mdi-send-variant"
                  >
                    Send Message
                  </v-btn>
                </v-col>
              </v-row>
            </v-form>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-container>
</template>

<script setup>
const submitForm = () => {
  // Logic to handle form submission (e.g., Axios call to Laravel backend)
  console.log('Form Submitted');
};
</script>

<style scoped>
.min-vh-100 { min-height: 100vh; }
.letter-spacing-2 { letter-spacing: 2px; }
.z-index-2 { z-index: 2; }

/* Contact Form Styling */
.contact-form-card {
  background: rgba(2, 24, 48, 0.6) !important; /* inputBg with transparency */
  backdrop-filter: blur(10px);
  border-radius: 24px !important;
  border-color: rgba(52, 62, 75, 0.5) !important;
}

/* Moving Background Glows */
.contact-glow-1 {
  position: absolute;
  top: -10%;
  right: -5%;
  width: 500px;
  height: 500px;
  background: radial-gradient(circle, rgba(0, 128, 255, 0.15) 0%, transparent 70%);
  z-index: 1;
}

.contact-glow-2 {
  position: absolute;
  bottom: -10%;
  left: -5%;
  width: 400px;
  height: 400px;
  background: radial-gradient(circle, rgba(242, 18, 2, 0.1) 0%, transparent 70%);
  z-index: 1;
}

/* Vuetify Input Customization */
:deep(.v-field) {
  border-radius: 12px !important;
}
</style>