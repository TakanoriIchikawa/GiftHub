<template>
    <div>
        <sidebar-component></sidebar-component>
        <div class="c-wrapper c-fixed-components">
        <header-component></header-component>
            <div class="c-body">
                <main class="c-main">
                    <div class="container fade-in">

                        <router-view></router-view>

                    </div>
                </main>
                <footer-component></footer-component>
            </div>
        </div>
    </div>
</template>

<script>
import Sidebar from './Sidebar.vue'
import Header from './Header.vue'
import Footer from './Footer.vue'

export default {
    components: {
        'sidebar-component': Sidebar,
        'header-component': Header,
        'footer-component': Footer,
    },
}
</script>
