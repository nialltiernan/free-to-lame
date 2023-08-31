import {createApp} from 'vue'

import Loading from 'equal-vue'
import '../../node_modules/equal-vue/dist/style.css'

import App from './App.vue'

import Router from '../Router/Router.js';
import Store from '../Store/Store.js'

createApp(App).use(Router).use(Store).use(Loading).mount(document.getElementById('vueApp'))