import {createStore} from 'vuex'

const store = createStore({
    state() {
        return {
            user: null
        }
    },
    mutations: {
        logIn(state, user) {
            state.user = user
        },
        logOut(state) {
            state.user = null;
        }
    },
    getters: {
        isLoggedIn(state) {
            return state.user !== null;
        },
        loggedInUser(state) {
            return state.user;
        },
    }
})

export default store;
