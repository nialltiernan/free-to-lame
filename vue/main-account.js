import {createApp} from 'vue'

import {Loading, Modal} from 'equal-vue'
import '../node_modules/equal-vue/dist/style.css'

import AppAccount from './AppAccount.vue'

let container = document.getElementById('vueAppAccount');

let props = {
    userId: container.dataset.user
};

createApp(AppAccount, props).use(Loading).use(Modal).mount(container)
