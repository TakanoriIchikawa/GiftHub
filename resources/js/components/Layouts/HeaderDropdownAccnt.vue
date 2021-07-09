<template>
  <label class="m-0">
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
            v-show="user_image"
            :src="user_image"
            class="c-avatar-img"
          />
        </div>
      </CHeaderNavLink>
    </template>
    <CDropdownHeader tag="div" class="text-center" color="light">
      <strong>コミュニティ</strong>
    </CDropdownHeader>
    <CDropdownItem to="/friend/list">
      <CIcon name="cil-group" /> 友達
      <CBadge color="primary" class="mfs-auto">20</CBadge>
    </CDropdownItem>
    <CDropdownItem to="/chat/list">
      <CIcon name="cil-chat-bubble" /> チャット
      <CBadge color="warning" class="mfs-auto">4</CBadge>
    </CDropdownItem>

    <CDropdownHeader tag="div" class="text-center" color="light">
      <strong>アカウント</strong>
    </CDropdownHeader>
    <CDropdownItem to="/profile">
      <CIcon name="cil-user" /> プロフィール
    </CDropdownItem>
    <CDropdownItem>
      <CIcon name="cil-settings" /> 設定
    </CDropdownItem>
    <CDropdownDivider/>
    <CDropdownItem @click="logout()">
      <CIcon name="cil-lock-locked" /> ログアウト
    </CDropdownItem>
  </CDropdown>
  </label>

</template>

<script>
export default {
    methods: {
        findUser: async function() {
            const url = '/api/find/user'
            await axios.get(url)
            .then (response => {
                this.user_image = response.data.image
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
        this.findUser()
    },
  data () {
      return {
          user_image: '',
      }
  }
}
</script>

<style scoped>
.c-icon {
    margin-right: 0.3rem;
}
</style>