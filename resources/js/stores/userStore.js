import { defineStore } from 'pinia'
import axios from '@/utils/axios'

export const useUserStore = defineStore('user', {
  state: () => ({
    user: {},
    is_logged_in: false,
    checked: false,
  }),

  actions: {
    async login(data) {
      const res = await axios.post('/login', data)

      localStorage.setItem('auth_token', res.data.token)
      axios.defaults.headers.common['Authorization'] =
        `Bearer ${res.data.token}`

      this.user = res.data.user
      this.is_logged_in = true
    },

    async getProfile() {
      const res = await axios.get('/profile')
      return res.data
    },

    logout() {
      localStorage.removeItem('auth_token')
      this.user = {}
      this.is_logged_in = false
    },
  },
})
