// 認証系コンポーネント
import Register from '../components/Auth/Register.vue';
import Login from '../components/Auth/Login.vue';

// 親コンポーネント
import App from '../components/Layouts/App.vue'

// 子コンポーネント
import ItemA from '../components/Theme/ItemA.vue';
import ItemB from '../components/Theme/ItemB.vue';
import GivePoint from '../components/Point/GivePoint.vue';
import GiftCategories from '../components/Gift/GiftCategories.vue';
import GiftItems from '../components/Gift/GiftItems.vue';

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
                path: 'give-point',
                name: 'Give Point',
                component: GivePoint,
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: 'gift',
                redirect: '/gift/category',
                meta: {
                    label: 'Gift'
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
                        component: GiftCategories,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                    {
                        path: ':gift_category_id',
                        name: 'Items',
                        component: GiftItems,
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