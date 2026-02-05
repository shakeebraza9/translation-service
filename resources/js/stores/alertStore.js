// resources/js/stores/alertStore.js
import { defineStore } from 'pinia'

export const useAlertStore = defineStore('alert', {
  state: () => ({
    message: '',
  }),
  actions: {
    setMessage(msg) {
      this.message = msg
    },
  },
})
