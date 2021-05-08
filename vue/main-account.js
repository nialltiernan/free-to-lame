import {createApp} from 'vue'

import {Avatar, ColorPicker, Divider, Icon, Input, Loading, Modal} from 'equal-vue'
import '../node_modules/equal-vue/dist/style.css'

import AppAccount from './AppAccount.vue'

let container = document.getElementById('vueAppAccount');

let props = {
    userId: container.dataset.user
};

createApp(AppAccount, props)
    .use(Avatar)
    .use(ColorPicker)
    .use(Divider)
    .use(Icon)
    .use(Input)
    .use(Loading)
    .use(Modal)
    .mount(container)