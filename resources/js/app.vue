<template>
  <router-view />
  <Alert />
</template>

<script>
import Alert from '@/components/Alert.vue' // path check kar lo
export default {
  components: {
    Alert,
  },
}
</script>
