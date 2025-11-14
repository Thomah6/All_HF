import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import 'boxicons';
const app = createApp(App)

app.use(router)

app.mount('#app')
