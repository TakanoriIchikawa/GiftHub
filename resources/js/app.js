// Bootstrap
require('./bootstrap');
// Coreui
require('./coreui.bundle.min.js');

// window.Vue = require('vue');
import Vue from 'vue';
import router from './router/index.js';
import store from './store/index.js';
window.state = store.state;

Vue.component('app-component', require('./components/Layouts/AppComponent.vue').default);

const newApp = async () => {
    await store.dispatch('auth/currentUser')

    const app = new Vue({
        el: '#app',
        router,
        store,
    });
}

newApp()