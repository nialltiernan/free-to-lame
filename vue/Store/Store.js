import {createStore} from 'vuex'

const Store = createStore({
    state() {
        return {
            user: null,
            color: 'blue',
            homepageGames: []
        }
    },
    mutations: {
        logIn(state, user) {
            state.user = user
        },
        logOut(state) {
            state.user = null;
        },
        color(state, color) {
            state.color = color;
        },
        homepageGames(state, games) {
            state.homepageGames = games;
        }
    },
    getters: {
        isLoggedIn(state) {
            return state.user !== null;
        },
        loggedInUser(state) {
            return state.user;
        },
        color(state) {
            return state.color;
        },
        homepageGames(state) {
            return state.homepageGames
        }
    }
})

export default Store;