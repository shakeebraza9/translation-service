import { createApp } from 'vue'
import router from './routes'
import pinia from './stores'
import vuetify from './plugins/vuetify';
import '@mdi/font/css/materialdesignicons.css'
import App from './App.vue'

const app = createApp(App)

app.use(pinia)
app.use(router)
app.use(vuetify)

app.mount('#userApp')
