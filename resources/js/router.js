import Vue from 'vue'
import VueRouter from 'vue-router';
import test1 from './components/test1.vue';
import test2 from './components/test2.vue';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/test1',
            name: 'test1',
            component: test1
        },
        {
            path: '/test2',
            name: 'test2',
            component: test2
        },
    ]
});