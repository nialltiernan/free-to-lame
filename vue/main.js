import {createApp} from 'vue'

import Loading from 'equal-vue'
import '../node_modules/equal-vue/dist/style.css'

import App from './App.vue'

import Router from './router.js';

let container = document.getElementById('vueApp');

let props = {
    color: container.dataset.color
};

createApp(App, props).use(Router).use(Loading).mount(container)
