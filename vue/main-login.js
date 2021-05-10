import {createApp} from 'vue'

import {Icon, Input} from 'equal-vue'
import '../node_modules/equal-vue/dist/style.css'

import AppLogin from './AppLogin.vue'

createApp(AppLogin)
    .use(Icon)
    .use(Input)
    .mount(document.getElementById('vueAppLogin'))