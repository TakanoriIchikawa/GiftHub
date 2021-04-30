import Register from '../components/Auth/Register.vue';
import Login from '../components/Auth/Login.vue';
import App from '../components/Layouts/App.vue'

import test1 from '../components/test1.vue';
import test2 from '../components/test2.vue';


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
    {
        path: '/',
        component: App,
        children: [
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
                component: test2,
                meta: {
                    requiresAuth: true,
                },
            },
        ],
    },
];

export default routes;