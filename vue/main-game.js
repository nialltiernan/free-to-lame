import {createApp} from 'vue'

import Loading from 'equal-vue'
import '../node_modules/equal-vue/dist/style.css'

import AppGame from './AppGame.vue'

let container = document.getElementById('vueAppGame');

let props = {
    gameId: container.dataset.gameid,
    color: container.dataset.color
};

createApp(AppGame, props).use(Loading).mount(container)
