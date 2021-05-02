import { createApp } from 'vue'

import Loading from 'equal-vue'
import '../node_modules/equal-vue/dist/style.css'

import AppCategory from './AppCategory.vue'

let container = document.getElementById('vueAppCategory');

let props = {
    category: container.dataset.category
};

createApp(AppCategory, props).use(Loading).mount(container)
