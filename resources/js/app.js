import { createApp } from 'vue'
import router from './routes'
import pinia from './stores'
import vuetify from './plugins/vuetify';
import '@mdi/font/css/materialdesignicons.css'
import App from './App.vue'
import { useAlertStore } from '@/stores/alertStore'

const app = createApp(App)

app.use(pinia)
app.use(router)
app.use(vuetify)
app.config.globalProperties.$alertStore = useAlertStore()
app.mount('#userApp')
