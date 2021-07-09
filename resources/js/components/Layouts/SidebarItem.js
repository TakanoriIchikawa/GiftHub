export default [
    {
        _name: 'CSidebarNav',
        _children: [
            {
                _name: 'CSidebarNavItem',
                name: 'ダッシュボード',
                to: '/dashboard',
                icon: 'cil-speedometer',
                badge: {
                    color: 'primary',
                    text: 'NEW'
                }
            },
            {
                _name: 'CSidebarNavTitle',
                _children: ['Theme']
            },
            {
                _name: 'CSidebarNavItem',
                name: '友達',
                to: '/friend/list',
                icon: 'cil-user',
            },
            {
                _name: 'CSidebarNavItem',
                name: 'チャット',
                to: '/chat',
                icon: 'cil-chat-bubble'
            },
            {
                _name: 'CSidebarNavItem',
                name: 'ポイント購入',
                to: '/points/grant',
                icon: 'cil-smile-plus'
            },
            {
                _name: 'CSidebarNavItem',
                name: '記録',
                to: '/history',
                icon: 'cil-history'
            },
            {
                _name: 'CSidebarNavItem',
                name: '景品',
                to: '/gift/category',
                icon: 'cil-gift',
                badge: {
                    color: 'primary',
                    text: 'NEW',
                    shape: 'pill'
                },
            },
            {
                _name: 'CSidebarNavDivider',
                _class: 'm-2'
            },
            {
                _name: 'CSidebarNavTitle',
                _children: ['Extras']
            },
            {
                _name: 'CSidebarNavDropdown',
                name: 'App Configuration',
                icon: 'cil-applications',
                items: [
                    {
                        name: 'Laravel',
                        to: '#',
                        icon: 'cib-laravel',
                    },
                    {
                        name: 'Vue.js',
                        to: '#',
                        icon: 'cib-vue-js',
                    },
                    {
                        name: 'MySQL',
                        to: '#',
                        icon: 'cib-mysql',
                    },
                    {
                        name: 'AWS',
                        to: '#',
                        icon: 'cib-amazon-aws',
                    },
                ]
            },
            {
                _name: 'CSidebarNavItem',
                name: 'Contact Mail',
                to: '/contact',
                icon: { name: 'cil-envelope-open', class: 'text-white' },
                _class: 'bg-success text-white',
            },
            {
                _name: 'CSidebarNavItem',
                name: 'Github Repository',
                href: 'https://github.com/TakanoriIchikawa/SAMPLE',
                icon: { name: 'cib-github', class: 'text-white' },
                _class: 'bg-danger text-white',
                target: '_blank'
            }
        ]
    }
]