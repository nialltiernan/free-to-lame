import {createApp} from 'vue'

import Loading from 'equal-vue'
import '../node_modules/equal-vue/dist/style.css'

import App from './App.vue'

let container = document.getElementById('vueApp');

let props = {
    color: container.dataset.color
};

createApp(App, props).use(Loading).mount(container)
