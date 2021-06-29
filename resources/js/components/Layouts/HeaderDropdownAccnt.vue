<template>
  <label class="m-0" @click="getDashboardData">
  <CDropdown
    inNav
    class="c-header-nav-items"
    placement="bottom-end"
    add-menu-classes="pt-0"
  >
    <template #toggler>
      <CHeaderNavLink>
        <div class="c-avatar">
          <img
            :src="'/storage/img/avatars/1.jpg'"
            class="c-avatar-img"
          />
        </div>
      </CHeaderNavLink>
    </template>
    <CDropdownHeader tag="div" class="text-center" color="light">
      <strong>Points</strong>
    </CDropdownHeader>
    <CDropdownItem>
      <CIcon name="cil-star"/> Available
      <CBadge color="primary" class="mfs-auto">{{ points.available_point.toLocaleString() }}</CBadge>
    </CDropdownItem>
    <CDropdownItem>
      <CIcon name="cil-smile" /> Gave
      <CBadge color="info" class="mfs-auto">{{ points.gave_point.toLocaleString() }}</CBadge>
    </CDropdownItem>
    <CDropdownItem>
      <CIcon name="cil-heart" /> Received
      <CBadge color="success" class="mfs-auto">{{ points.received_point.toLocaleString() }}</CBadge>
    </CDropdownItem>
    <CDropdownItem>
      <CIcon name="cil-gift" /> Exchange
      <CBadge color="danger" class="mfs-auto">{{ points.exchangeable_point.toLocaleString() }}</CBadge>
    </CDropdownItem>
    <CDropdownHeader tag="div" class="text-center" color="light">
      <strong>Settings</strong>
    </CDropdownHeader>
    <CDropdownItem href="/friends/list">
      <CIcon name="cil-group" /> Friends
      <CBadge color="primary" class="mfs-auto">20</CBadge>
    </CDropdownItem>
    <CDropdownItem href="/chat/list">
      <CIcon name="cil-chat-bubble" /> Chat
      <CBadge color="warning" class="mfs-auto">4</CBadge>
    </CDropdownItem>

    <CDropdownHeader tag="div" class="text-center" color="light">
      <strong>Settings</strong>
    </CDropdownHeader>
    <CDropdownItem href="/profile">
      <CIcon name="cil-user" /> Profile
    </CDropdownItem>
    <CDropdownItem>
      <CIcon name="cil-settings" /> Settings
    </CDropdownItem>
    <CDropdownDivider/>
    <CDropdownItem @click="logout()">
      <CIcon name="cil-lock-locked" /> Logout
    </CDropdownItem>
  </CDropdown>
  </label>

</template>

<script>
export default {
    methods: {
        getDashboardData: async function() {
            const url = '/api/get/dashboard/data'
            await axios.get(url)
            .then ( response => {
                this.points = response.data.points
                this.list = response.data.list
            }).catch ( error => {
                if (error.response.status === 401) {
                    this.$router.push({name:'Login'})
                } else {
                    console.log(error)
                }
            })
        },
        logout: async function() {
            await this.$store.dispatch('auth/logout')
            this.$router.push({name:'Login'})
        },
  },
      mounted() {
        this.getDashboardData()
    },
  data () {
      return {
          points: {},
          itemsCount: 42
      }
  }
}
</script>

<style scoped>
.c-icon {
    margin-right: 0.3rem;
}
</style>