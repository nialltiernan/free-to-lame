import {createApp} from 'vue'

import Equal from 'equal-vue'

import '../node_modules/equal-vue/dist/style.css'

import AppAccount from './AppAccount.vue'

let container = document.getElementById('vueAppAccount');

let props = {
    userId: container.dataset.user,
    color: container.dataset.color
};

createApp(AppAccount, props).use(Equal).mount(container)