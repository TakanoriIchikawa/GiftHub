<template>

<div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 col-6">
        <div class="card">
            <header class="card-header">
                <svg class="c-icon">
                    <use xlink:href="/assets/coreui.icon.svg#cil-grain"></use>
                </svg>
                <strong class="px-2"> Chat List </strong>
                <small>Enjoy chatting with your friends</small>
            </header>
            <div class="card-body">
                <ul role="list-items" class="list-group">
                    <router-link v-for="chat in chats" :key="chat.user.id"
                                :to="{ name:'ChatRoom', params:{ receive_user_id: chat.user.id,}}"
                                class="text-decoration-none">
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="c-avatar">
                                    <img :src="'/assets/img/avatars/' + chat.user.image" class="c-avatar-img">
                                    <span class="c-avatar-status bg-success"></span>
                                </div>
                                <div class="pl-3">
                                    <div>
                                        <strong>{{ chat.user.name }}</strong>
                                    </div>
                                    <div>
                                        <small>{{ chat.latest_chat_message }}</small>                                   
                                    </div>
                                </div>
                            </div>
                            <div class="d-none d-sm-flex align-items-center">
                                <strong>{{ chat.latest_chat_message_date }}</strong>
                            </div>
                        </li>
                    </router-link>
                </ul>
            </div>
        </div>
    </div>
</div>

</template>

<script>

export default {
    methods: {
        getChats: async function() {
            const url = '/api/get/chats'
            await axios.get(url)
            .then ( response => {
                this.chats = response.data
            }).catch ( error => {
                if (error.response.status === 401) {
                    this.$router.push({name:'Login'})
                } else {
                    console.log(error)
                }
            })
        }
    },
    mounted: function() {
        this.getChats()
    },
    data() {
        return {
            chats: {}
        }
    }
}
</script>

<style scoped>
.list-group-item {
    color: #212529;
}

.text-decoration-none:hover {
    text-decoration: none;
}
</style>
