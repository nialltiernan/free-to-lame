import { createApp } from 'vue'

import GameDetails from './GameDetails.vue'

let container = document.getElementById('vueGameDetails');

let props = {
    gameId: container.dataset.gameid
};

createApp(GameDetails, props).mount(container)