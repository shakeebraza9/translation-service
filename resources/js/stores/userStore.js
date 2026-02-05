// resources/js/stores/userStore.js
import { defineStore } from 'pinia'

export const useUserStore = defineStore('user', {
  state: () => ({
    user: {},
    is_logged_in: false,
  }),
  actions: {
    async getProfile() {
      // temporary mock
      return { user: { name: 'Shakeeb' } }
    },
  },
})
