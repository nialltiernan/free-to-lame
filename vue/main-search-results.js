import {createApp} from 'vue'

import Loading from 'equal-vue'
import '../node_modules/equal-vue/dist/style.css'

import AppSearchResults from './AppSearchResults.vue'

let container = document.getElementById('vueAppSearchResults');

let props = {
    terms: container.dataset.terms,
    color: container.dataset.color
};

createApp(AppSearchResults, props).use(Loading).mount(container)
