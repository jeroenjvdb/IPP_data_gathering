import 'babel-polyfill';

require('./bootstrap');

import Vue from 'vue';
import router from './router';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

new Vue({
    el: '#app',
    router,
});
