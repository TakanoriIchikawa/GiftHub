// Bootstrap
require('./bootstrap');
// Coreui
require('./coreui.bundle.min.js');

// window.Vue = require('vue');
import Vue from 'vue'
import router from './router'

Vue.component('app-component', require('./components/Layouts/AppComponent.vue').default);

const app = new Vue({
    el: '#app',
    router: router
});
