/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'

Vue.use(VueRouter)


import Home from './components/HomeComponent.vue';
import Task from './components/TaskComponent.vue';

const routes = [
    {   
        path: '/',
        component: Home
    },
    {   
        path: '/tasks',
        component: Task
    }
];

const router = new VueRouter({routes});


const app = new Vue({ 
    el: '#app',
    router: router
});
