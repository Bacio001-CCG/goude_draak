import './bootstrap';
import { createApp } from 'vue'
import menuList from '../views/components/admin/menuList.vue'
import schedule from '../views/components/admin/schedule.vue'

const app = createApp()

app.component('menuList', menuList)
app.component('schedule', schedule)

app.mount('#app')