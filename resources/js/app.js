import './bootstrap';
import { createApp } from 'vue'
import menuList from '../views/components/admin/menuList.vue'
import schedule from '../views/components/admin/schedule.vue'
import orderList from '../views/components/checkout/orderList.vue'
import productList from '../views/components/checkout/productList.vue'
import orderDisplayList from '../views/components/checkout/orderDisplayList.vue'
import orderItemNote from '../views/components/checkout/orderItemNote.vue'

const app = createApp()

app.component('menuList', menuList)
app.component('schedule', schedule)
app.component('orderList', orderList)
app.component('productList', productList)
app.component('orderDisplayList', orderDisplayList)
app.component('orderItemNote', orderItemNote)

app.mount('#app')