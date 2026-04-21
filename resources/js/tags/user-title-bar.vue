<template>
  <div class="position-relative w-100 bg-surface pt-10 pb-8">

    <div class="pattern-bg"></div>

    <div class="position-relative pt-5 mx-auto px-4" style="max-width: 1400px; z-index: 10">

      <h1 class="text-lg-h4 text-md-h5 text-h4 mb-2 font-weight-bold">
        {{ title }}
      </h1>

      <p v-if="subtitle" class="text-subtitle-1 mb-2 font-weight-medium">
        {{ subtitle }}
      </p>

      <!-- ✅ SAFE SLOT -->
      <div v-if="$slots.default" class="mt-3">
        <slot />
      </div>

    </div>
  </div>
</template>

<script>
export default {
  name: "UserTitleBar",
  props: {
    title: String,
    subtitle: String
  }
};
</script>

<style scoped>
.pattern-bg {
  position: absolute;
  inset: 0;
  background-image: radial-gradient(#0080ff 1.5px, transparent 1.2px);
  background-size: 16px 16px;
  opacity: 0.25;
}
</style>