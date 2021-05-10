import {createApp} from 'vue'

import Equal from 'equal-vue'
import '../node_modules/equal-vue/dist/style.css'

import AppLogin from './AppLogin.vue'

createApp(AppLogin).use(Equal).mount(document.getElementById('vueAppLogin'))