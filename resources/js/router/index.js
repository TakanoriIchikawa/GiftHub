import Vue from 'vue'
import VueRouter from 'vue-router';
import Store from '../store/index.js'

import Register from '../components/Auth/Register.vue';
import Login from '../components/Auth/Login.vue';

import test1 from '../components/test1.vue';
import test2 from '../components/test2.vue';

Vue.use(VueRouter);

const routes = [
    {
        path: '/register',
        name: Register,
        component: Register,
    },
    {
        path: '/login',
        name: Login,
        component: Login,
    },
    // {
    //     path: '/logout',
    //     name: Logout,
    //     component: Logout
    // },
    {
        path: '/test1',
        name: test1,
        component: test1,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/test2',
        name: test2,
        meta: {
            requiresAuth: true,
        },
    },
];

const router = new VueRouter({
    mode: 'history',
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        console.log('通過です。')
        console.log(Store.getters['auth/check'])
        console.log(Store.state)

        if (Store.getters['auth/check'] === false) {
            next('/login')
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;