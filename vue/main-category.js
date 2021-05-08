import {createApp} from 'vue'

import {Loading, Select} from 'equal-vue'
import '../node_modules/equal-vue/dist/style.css'

import AppCategory from './AppCategory.vue'

let container = document.getElementById('vueAppCategory');

let props = {
    category: container.dataset.category,
    color: container.dataset.color
};

createApp(AppCategory, props)
    .use(Loading)
    .use(Select)
    .mount(container)
