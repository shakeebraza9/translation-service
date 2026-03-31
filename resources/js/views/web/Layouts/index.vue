<template>
  <v-app>
    <AppHeader />
    
    <v-main class="bg-grey-lighten-4">
      <router-view />
    </v-main>

    <AppFooter />
  </v-app>
</template>

<script setup>
import AppHeader from './AppHeader.vue';
import AppFooter from './AppFooter.vue';
</script>