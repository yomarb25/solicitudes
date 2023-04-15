import './bootstrap';

import { createApp, markRaw } from 'vue'
import { createPinia } from 'pinia'
import router from "./router"
import App from './pages/App.vue'
import 'vue3-toastify/dist/index.css';

const pinia = createPinia()
pinia.use(({ store }) => {
    store.router = markRaw(router)
})

createApp(App)
.use(pinia)
.use(router)
.mount('#app');
