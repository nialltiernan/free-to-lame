import {createStore} from 'vuex'

const store = createStore({
    state() {
        return {
            user: null,
            color: 'blue'
        }
    },
    mutations: {
        logIn(state, user) {
            state.user = user
        },
        logOut(state) {
            state.user = null;
        },
        setColor(state, color) {
            state.color = color;
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
        }
    }
})

export default store;
