import {createApp} from 'vue'

import Equal from 'equal-vue'
import '../node_modules/equal-vue/dist/style.css'

import AppCategoryList from './AppCategoryList.vue'

createApp(AppCategoryList).use(Equal).mount(document.getElementById('vueAppCategoryList'))
