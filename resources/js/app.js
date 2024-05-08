import './bootstrap';
import { createApp } from 'vue'
import counter from '../views/components/counter.vue'

const app = createApp()

app.component('counter', counter)

app.mount('#app')