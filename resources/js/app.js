import './bootstrap';
import { createApp } from 'vue'
import menuList from '../views/components/admin/menuList.vue'

const app = createApp()

app.component('menuList', menuList)

app.mount('#app')