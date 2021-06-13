// 認証系コンポーネント
import Register from '../components/Auth/Register.vue';
import Login from '../components/Auth/Login.vue';

// 親コンポーネント
import App from '../components/Layouts/App.vue'

// 子コンポーネント
import ItemA from '../components/Theme/ItemA.vue';
import ItemB from '../components/Theme/ItemB.vue';
import GivePoint from '../components/Points/GivePoint.vue';
import GrantPoint from '../components/Points/GrantPoint.vue';
import FriendList from '../components/Friends/FriendList.vue';
import FriendAdd from '../components/Friends/FriendAdd.vue';
import GiftCategories from '../components/Gifts/GiftCategories.vue';
import GiftItems from '../components/Gifts/GiftItems.vue';

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
                path: 'points',
                redirect: '/points/give',
                meta: {
                    label: 'Points'
                },
                component: {
                    render(c) {
                        return c('router-view')
                    }
                },
                children: [
                    {
                        path: 'give',
                        name: 'Give',
                        component: GivePoint,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                    {
                        path: 'grant',
                        name: 'Grant',
                        component: GrantPoint,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                ],
            },
            {
                path: 'friends',
                redirect: '/friends/list',
                meta: {
                    label: 'Friends'
                },
                component: {
                    render(c) {
                        return c('router-view')
                    }
                },
                children: [
                    {
                        path: 'list',
                        name: 'FriendList',
                        component: FriendList,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                    {
                        path: 'add',
                        name: 'FriendAdd',
                        component: FriendAdd,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                ],
            },
            {
                path: 'gifts',
                redirect: '/gifts/category',
                meta: {
                    label: 'Gifts'
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
                        path: 'items/:gift_category_id',
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