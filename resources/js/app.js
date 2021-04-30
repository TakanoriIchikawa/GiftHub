import './bootstrap'
import './coreui/coreui.bundle.min.js'
import './validate/index.js';

// window.Vue = require('vue');
// window.state = store.state;

import Vue from 'vue';
import router from './router/index.js';
import store from './store/index.js';

const app = new Vue({
    el: '#app',
    router,
    store,
});