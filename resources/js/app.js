import './bootstrap'
import './plugin/coreui.js'
import './plugin/validate.js';

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