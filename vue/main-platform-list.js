import {createApp} from 'vue'

import Equal from 'equal-vue'
import '../node_modules/equal-vue/dist/style.css'

import AppPlatformList from './AppPlatformList.vue'

createApp(AppPlatformList).use(Equal).mount(document.getElementById('vueAppPlatformList'))
