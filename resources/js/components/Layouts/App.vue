<template>
  <div class="c-app">
    <sidebar-component></sidebar-component>
    <CWrapper>
      <header-component></header-component>
      <div class="c-body">
        <main class="c-main">
          <CContainer fluid>
            <transition name="fade" mode="out-in">
              <router-view :key="$route.path"></router-view>
            </transition>
          </CContainer>
        </main>
      </div>
      <footer-component></footer-component>
    </CWrapper>
  </div>
</template>

<script>
import Sidebar from './Sidebar'
import Header from './Header'
import Footer from './Footer'

export default {
    components: {
        'sidebar-component': Sidebar,
        'header-component': Header,
        'footer-component': Footer,
    }
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
}
.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>
