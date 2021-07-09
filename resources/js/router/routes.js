// 認証系コンポーネント
import Register from '../components/Auth/Register.vue';
import Login from '../components/Auth/Login.vue';

// 親コンポーネント
import App from '../components/Layouts/App.vue'

// 子コンポーネント
import Dashboard from '../components/Theme/Dashboard.vue';
import Profile from '../components/Theme/Profile.vue';
import Contact from '../components/Theme/Contact.vue';
import GivePoint from '../components/Point/GivePoint.vue';
import GrantPoint from '../components/Point/GrantPoint.vue';
import FriendList from '../components/Friend/FriendList.vue';
import FriendAdd from '../components/Friend/FriendAdd.vue';
import ChatList from '../components/Chat/ChatList.vue';
import ChatRoom from '../components/Chat/ChatRoom.vue';
import GiftCategories from '../components/Gift/GiftCategories.vue';
import GiftItems from '../components/Gift/GiftItems.vue';
import History from '../components/History/History.vue';

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
        redirect: '/dashboard',
        name: 'ホーム',
        component: App,
        children: [
            {
                path: 'dashboard',
                name: 'ダッシュボード',
                component: Dashboard,
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: 'profile',
                name: 'プロフィール',
                component: Profile,
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: 'points',
                redirect: '/points/grant',
                meta: {
                    label: 'ポイント'
                },
                component: {
                    render(c) {
                        return c('router-view')
                    }
                },
                children: [
                    {
                        path: 'give',
                        name: 'ポイントを贈る',
                        component: GivePoint,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                    {
                        path: 'grant',
                        name: 'ポイント購入',
                        component: GrantPoint,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                ],
            },
            {
                path: 'friend',
                redirect: '/friend/list',
                meta: {
                    label: '友達'
                },
                component: {
                    render(c) {
                        return c('router-view')
                    }
                },
                children: [
                    {
                        path: 'list',
                        name: '友達の一覧',
                        component: FriendList,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                    {
                        path: 'add',
                        name: '友達を追加',
                        component: FriendAdd,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                ],
            },
            {
                path: 'chat',
                redirect: '/chat/list',
                meta: {
                    label: 'チャット'
                },
                component: {
                    render(c) {
                        return c('router-view')
                    }
                },
                children: [
                    {
                        path: 'list',
                        name: 'チャットの一覧',
                        component: ChatList,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                    {
                        path: 'room/:receive_user_id',
                        name: 'チャットルーム',
                        component: ChatRoom,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                ],
            },
            {
                path: 'gift',
                redirect: '/gift/category',
                meta: {
                    label: '景品'
                },
                component: {
                    render(c) {
                        return c('router-view')
                    }
                },
                children: [
                    {
                        path: 'category',
                        name: 'カテゴリ',
                        component: GiftCategories,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                    {
                        path: 'item/:gift_category_id',
                        name: 'アイテム',
                        component: GiftItems,
                        meta: {
                            requiresAuth: true,
                        },
                    },
                ]
            },
            {
                path: 'history',
                name: '記録',
                component: History,
                meta: {
                    requiresAuth: true,
                },
            },
            {
                path: 'contact',
                name: 'お問い合わせ',
                component: Contact,
                meta: {
                    requiresAuth: true,
                },
            },
        ],
    },
];

export default routes;