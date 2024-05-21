import './bootstrap';
import { createApp } from 'vue'
import menuList from '../views/components/admin/menuList.vue'
import publicMenu from '../views/components/public/menu.vue'
import schedule from '../views/components/admin/schedule.vue'

const app = createApp()

app.component('menuList', menuList)
app.component('publicMenu', publicMenu)
app.component('schedule', schedule)

app.mount('#app')