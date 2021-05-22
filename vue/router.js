import {createRouter, createWebHistory} from 'vue-router';

import Homepage from './views/Homepage.vue';
import Platform from './views/Platform.vue';
import Platforms from './views/Platforms.vue';
import Categories from './views/Categories.vue';
import Category from './views/Category.vue';
import Game from './views/Game.vue';
import Login from './views/Login.vue';
import Register from './views/Register.vue';
import Account from './views/Account.vue';
import SearchResults from './views/SearchResults.vue';

const routes = [
    {path: '/', name: 'Home', component: Homepage},
    {path: '/game/:gameId', name: 'Game', component: Game, props: true},
    {path: '/platforms', name: 'Platforms', component: Platforms},
    {path: '/platform/:platform', name: 'Platform', component: Platform, props: true},
    {path: '/categories', name: 'Categories', component: Categories},
    {path: '/categories/:category', name: 'Category', component: Category, props: true},
    {path: '/login', name: 'Login', component: Login},
    {path: '/register', name: 'Register', component: Register},
    {path: '/account', name: 'Account', component: Account, props: true},
    {path: '/search-results', name: 'SearchResults', component: SearchResults, props: true},
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

export default router;
