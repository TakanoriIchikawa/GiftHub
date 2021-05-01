<template>
  <CSidebar 
    fixed 
    :minimize="minimize"
    :show="show"
    @update:show="(value) => $store.commit('coreui/set', ['sidebarShow', value])"
  >
    <CSidebarBrand class="d-md-down-none" to="/">
      <CIcon 
        class="c-sidebar-brand-full" 
        name="logo" 
        size="custom-size" 
        :height="35" 
        viewBox="0 0 556 134"
      />
      <CIcon 
        class="c-sidebar-brand-minimized" 
        name="logo" 
        size="custom-size" 
        :height="35" 
        viewBox="0 0 110 134"
      />
    </CSidebarBrand>

    <CRenderFunction flat :content-to-render="$options.SidebarItem"/>
    <CSidebarMinimizer
      class="d-md-down-none"
      @click.native="$store.commit('coreui/set', ['sidebarMinimize', !minimize])"
    />
  </CSidebar>
</template>

<script>
import SidebarItem from './SidebarItem'

export default {
    SidebarItem,
    computed: {
        show () {
            return this.$store.state.coreui.sidebarShow 
        },
        minimize () {
            return this.$store.state.coreui.sidebarMinimize 
        }
    }
}
</script>
