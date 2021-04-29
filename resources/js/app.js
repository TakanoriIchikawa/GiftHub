require('./bootstrap');
// Coreui
require('./coreui.bundle.min.js');

// window.Vue = require('vue');
import Vue from 'vue';
import router from './router/index.js';
import store from './store/index.js';
// window.state = store.state;

const newApp = async () => {
    await store.dispatch('auth/currentUser')

    const app = new Vue({
        el: '#app',
        router,
        store,
    });
}

newApp()