import { createApp } from 'vue'

import AppGame from './AppGame.vue'

let container = document.getElementById('vueAppGame');

let props = {
    gameId: container.dataset.gameid
};

createApp(AppGame, props).mount(container)