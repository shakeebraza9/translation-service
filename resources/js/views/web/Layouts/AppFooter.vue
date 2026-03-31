<template>
  <v-footer class="bg-grey-darken-4 text-center d-flex flex-column py-10">
    <div>
      <v-btn icon="mdi-github" variant="text" color="white"></v-btn>
      <v-btn icon="mdi-linkedin" variant="text" color="white"></v-btn>
      <v-btn icon="mdi-twitter" variant="text" color="white"></v-btn>
    </div>

    <div class="pt-4 text-grey">
      &copy; {{ new Date().getFullYear() }} — <strong>Portfolio</strong>
    </div>
  </v-footer>
</template>