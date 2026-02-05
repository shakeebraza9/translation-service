<template>
  <div class="login-page">
    <div class="login-card">
      <h2>Login</h2>

      <form @submit.prevent="submit">
        <div class="form-group">
          <label>Email</label>
          <input
            type="email"
            v-model="form.email"
            required
            placeholder="Enter email"
          />
        </div>

        <div class="form-group">
          <label>Password</label>
          <input
            type="password"
            v-model="form.password"
            required
            placeholder="Enter password"
          />
        </div>

        <button type="submit" :disabled="loading">
          {{ loading ? 'Logging in...' : 'Login' }}
        </button>

        <p v-if="error" class="error">{{ error }}</p>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useUserStore } from '@/stores/userStore'

const router = useRouter()
const userStore = useUserStore()

const form = ref({
  email: 'shakeeb@gmail.com',
  password: '123456789',
})

const loading = ref(false)
const error = ref('')

const submit = async () => {
  error.value = ''
  loading.value = true

  try {
    await userStore.login(form.value)
    router.push('/user/dashboard')
  } catch (e) {
    error.value = e.response?.data?.message || 'Invalid credentials'
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
.login-page {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #f5f6fa;
}

.login-card {
  width: 350px;
  padding: 25px;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0,0,0,.1);
}

h2 {
  text-align: center;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  font-size: 14px;
  margin-bottom: 5px;
}

input {
  width: 100%;
  padding: 8px;
  border-radius: 4px;
  border: 1px solid #ccc;
}

button {
  width: 100%;
  padding: 10px;
  background: #1976d2;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:disabled {
  background: #999;
}

.error {
  margin-top: 10px;
  color: red;
  text-align: center;
}
</style>
