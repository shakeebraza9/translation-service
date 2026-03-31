<template>
  <v-container fluid class="pa-0">
    <HeroSection />
    <AboutSection />
    <ExperienceSection />
    <ProjectSection />
  </v-container>
</template>

<script setup>
// Imports bilkul sahi hain
import HeroSection from '@/views/components/web/HeroSection.vue';
import AboutSection from '@/views/components/web/AboutSection.vue';
import ProjectSection from '@/views/components/web/ProjectSection.vue';
import ExperienceSection from '@/views/components/web/ExperienceSection.vue';

</script>