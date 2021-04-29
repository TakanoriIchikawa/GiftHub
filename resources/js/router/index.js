import Vue from 'vue'
import VueRouter from 'vue-router';
import routes from './routes.js'
import store from '../store/index.js'

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters['auth/check'] === false) {
            next('/login')
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;