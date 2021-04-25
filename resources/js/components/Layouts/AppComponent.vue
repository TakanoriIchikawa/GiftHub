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
import SidebarComponent from './SidebarComponent.vue'
import HeaderComponent from './HeaderComponent.vue'
import FooterComponent from './FooterComponent.vue'

export default {
    components: {
        'sidebar-component': SidebarComponent,
        'header-component': HeaderComponent,
        'footer-component': FooterComponent,
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>
