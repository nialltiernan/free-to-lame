import {createApp} from 'vue'

import Loading from 'equal-vue'
import '../node_modules/equal-vue/dist/style.css'

import App from './App.vue'

import router from './router.js';
import store from './store.js'

createApp(App)
    .use(router)
    .use(store)
    .use(Loading)
    .mount(document.getElementById('vueApp'))
