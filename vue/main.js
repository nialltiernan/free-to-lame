import { createApp } from 'vue'

import Loading from 'equal-vue'
import '../node_modules/equal-vue/dist/style.css'

import App from './App.vue'

createApp(App).use(Loading).mount(document.getElementById('vueApp'))
