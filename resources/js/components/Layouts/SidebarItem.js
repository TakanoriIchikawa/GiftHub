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
                name: 'Free Item',
                to: '/item-a',
                icon: 'cil-star'
            },
            {
                _name: 'CSidebarNavItem',
                name: 'Free Item',
                to: '/item-b',
                icon: 'cil-fire'
            },
            {
                _name: 'CSidebarNavTitle',
                _children: ['Components']
            },
            {
                _name: 'CSidebarNavDropdown',
                name: 'Group',
                route: '/group',
                icon: 'cil-group',
                items: [
                    {
                        name: 'Group A',
                        to: '/group/free-item-a'
                    },
                    {
                        name: 'Group B',
                        to: '/group/free-item-b'
                    },
                ]
            },
            {
                _name: 'CSidebarNavDropdown',
                name: 'Free Item',
                route: '#',
                icon: 'cil-snowflake',
                items: [
                    {
                        name: 'Free Item',
                        to: '#'
                    },
                    {
                        name: 'Free Item',
                        to: '#'
                    },
                ]
            },
            {
                _name: 'CSidebarNavDropdown',
                name: 'Free Item',
                route: '#',
                icon: 'cil-bolt',
                items: [
                    {
                        name: 'Free Item',
                        to: '#'
                    },
                    {
                        name: 'Free Item',
                        to: '#'
                    },
                ]
            },
            {
                _name: 'CSidebarNavItem',
                name: 'Free Item',
                to: '#',
                icon: 'cil-diamond',
                badge: {
                    color: 'primary',
                    text: 'NEW',
                    shape: 'pill'
                }
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
                name: 'Applicationsicon',
                route: '/code',
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
                    {
                        name: 'Github',
                        to: '#',
                        icon: 'cib-github',
                    },
                ]
            },
            {
                _name: 'CSidebarNavItem',
                name: 'Contact Mail',
                href: 'https://coreui.io/vue/demo/free/3.1.1/#/dashboard',
                icon: { name: 'cil-heart', class: 'text-white' },
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