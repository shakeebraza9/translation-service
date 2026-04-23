<template>
  <v-footer class="bg-grey-darken-4 text-center d-flex flex-column py-10">
    <div>
      <v-btn icon="mdi-github" variant="text" color="white" :href="globalStore.getSetting('github') || '#'" target="_blank"></v-btn>
      <v-btn icon="mdi-linkedin" variant="text" color="white" :href="globalStore.getSetting('linkdin') || '#' " target="_blank"></v-btn>
      <v-btn 
  icon="mdi-facebook" 
  variant="text" 
  color="white" 
  :href="globalStore.getSetting('facebook') || '#'" 
  target="_blank"
></v-btn>
    </div>

    <div class="pt-4 text-grey">
      &copy; {{ new Date().getFullYear() }} — <strong>Portfolio</strong>
    </div>
  </v-footer>
</template>

<script>
import { useGlobalSettingStore } from '@/stores/globalSetting'
export default {
  data() {
    return {
      globalStore: useGlobalSettingStore(),
    };
  },

  async mounted() {
   await this.globalStore.loadSettings()
  },


};
</script>