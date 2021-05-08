import {createApp} from 'vue'

import {Loading, Select} from 'equal-vue'
import '../node_modules/equal-vue/dist/style.css'

import AppPlatform from './AppPlatform.vue'

let container = document.getElementById('vueAppPlatform');

let props = {
    platform: container.dataset.platform,
    color: container.dataset.color
};

createApp(AppPlatform, props)
    .use(Loading)
    .use(Select)
    .mount(container)
