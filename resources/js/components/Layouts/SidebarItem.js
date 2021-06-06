export default [
    {
        _name: 'CSidebarNav',
        _children: [
            {
                _name: 'CSidebarNavItem',
                name: 'Dashboard',
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
                name: 'Points',
                to: '/points/give',
                icon: 'cil-smile'
            },
            {
                _name: 'CSidebarNavItem',
                name: 'Friends',
                to: '/friend',
                icon: 'cil-user',
            },
            {
                _name: 'CSidebarNavItem',
                name: 'Chat',
                to: '/chat',
                icon: 'cil-chat-bubble'
            },
            {
                _name: 'CSidebarNavItem',
                name: 'History',
                to: '/history',
                icon: 'cil-history'
            },
            {
                _name: 'CSidebarNavItem',
                name: 'Gifts',
                to: '/gifts/category',
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
                href: 'https://coreui.io/vue/demo/free/3.1.1/#/dashboard',
                icon: { name: 'cil-envelope-open', class: 'text-white' },
                _class: 'bg-success text-white',
                target: '_blank'
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