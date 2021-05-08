import {createApp} from 'vue'

import {Loading, Select} from 'equal-vue'
import '../node_modules/equal-vue/dist/style.css'

import AppPlatform from './AppPlatform.vue'

let container = document.getElementById('vueAppPlatform');

let props = {
    platform: container.dataset.platform
};

createApp(AppPlatform, props).use(Loading, Select).mount(container)
