import './bootstrap';
import { createApp } from 'vue'
import menuList from '../views/components/admin/menuList.vue'
import publicMenu from '../views/components/public/menu.vue'

const app = createApp()

app.component('menuList', menuList)
app.component('publicMenu', publicMenu)

app.mount('#app')