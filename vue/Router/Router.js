import {createRouter, createWebHistory} from 'vue-router';

import Homepage from '../Views/Homepage.vue';
import Platform from '../Views/Platform.vue';
import Platforms from '../Views/Platforms.vue';
import Categories from '../Views/Categories.vue';
import Category from '../Views/Category.vue';
import Game from '../Views/Game.vue';
import Login from '../Views/Login.vue';
import Register from '../Views/Register.vue';
import Account from '../Views/Account.vue';
import SearchResults from '../Views/SearchResults.vue';

const routes = [
    {path: '/', name: 'Home', component: Homepage},
    {path: '/game/:gameId', name: 'Game', component: Game, props: true},
    {path: '/platforms', name: 'Platforms', component: Platforms},
    {path: '/platform/:platform', name: 'Platform', component: Platform, props: true},
    {path: '/categories', name: 'Categories', component: Categories},
    {path: '/category/:category', name: 'Category', component: Category, props: true},
    {path: '/login', name: 'Login', component: Login},
    {path: '/register', name: 'Register', component: Register},
    {path: '/account', name: 'Account', component: Account, props: true},
    {path: '/search-results', name: 'SearchResults', component: SearchResults, props: true},
];

const Router = createRouter({
    history: createWebHistory(),
    routes: routes
});

export default Router;