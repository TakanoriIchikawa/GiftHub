import './bootstrap'
import './plugin/coreui.js'
import './plugin/validate.js';

import Vue from 'vue';
import router from './router/index.js';
import store from './store/index.js';
import { iconsSet as icons } from './icons/icons.js'

const app = new Vue({
    el: '#app',
    router,
    store,
    icons,
});