import {createApp} from 'vue'

import Equal from 'equal-vue'
import '../node_modules/equal-vue/dist/style.css'

import AppRegister from './AppRegister.vue'

createApp(AppRegister).use(Equal).mount(document.getElementById('vueAppRegister'))
