import { createApp } from 'vue'
import router from './routes'
import pinia from './stores'

import App from './App.vue'

const app = createApp(App)

app.use(pinia)
app.use(router)

app.mount('#userApp')
