// 認証系コンポーネント
import Register from '../components/Auth/Register.vue';
import Login from '../components/Auth/Login.vue';

// 親コンポーネント
import App from '../components/Layouts/App.vue'

// 子コンポーネント
import ItemA from '../components/Theme/ItemA.vue';
import ItemB from '../components/Theme/ItemB.vue';
import FreeItemA from '../components/Free/FreeItem/FreeItemA.vue';
import FreeItemB from '../components/Free/FreeItem/FreeItemB.vue';
import PrizeCategories from '../components/Prize/PrizeCategories.vue';
import Prizes from '../components/Prize/Prizes.vue';

const routes = [
    {
        path: '/register',
        name: 'Register',
        component: Register,
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
    },
    {
        path: '/',
        redirect: '/item-a',
        name: 'Home',
        component: App,
        children: [
            {
                path: 'item-a',
                name: 'ItemA',
                component: ItemA,
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: 'item-b',
                name: 'ItemB',
                component: ItemB,
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: 'group',
                redirect: '/group/free-item-a',
                meta: {
                    label: 'Group'
                },
                component: {
                    render(c) {
                        return c('router-view')
                    }
                },
                children: [
                    {
                        path: 'free-item-a',
                        name: 'FreeItemA',
                        component: FreeItemA,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                    {
                        path: 'free-item-b',
                        name: 'FreeItemB',
                        component: FreeItemB,
                        meta: {
                            requiresAuth: true,
                        },
                    }
                ]
            },
            {
                path: 'prize',
                redirect: '/prize/category',
                meta: {
                    label: 'Prize'
                },
                component: {
                    render(c) {
                        return c('router-view')
                    }
                },
                children: [
                    {
                        path: 'category',
                        name: 'Category',
                        component: PrizeCategories,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                    {
                        path: ':prize_category_path',
                        name: 'Prizes',
                        component: Prizes,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                ]
            },
        ],
    },
];

export default routes;