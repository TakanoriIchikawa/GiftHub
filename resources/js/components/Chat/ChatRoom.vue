<template>

<div class="row">
    <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
        <div class="card">
            <header class="card-header">
                <div class="d-flex align-items-center">
                    <div class="c-avatar">
                        <img :src="'/storage/img/avatars/' + receive_user_image" class="c-avatar-img">
                        <span class="c-avatar-status bg-success"></span>
                    </div>
                    <strong class="pl-3">{{ receive_user_name }}</strong>
                </div>
            </header>
            <div class="card-body" id="card-body">
                <div v-for="chatMessage in chatMessages" :key="chatMessage.id">
                    <div v-if="chatMessage.send_user_id === send_user_id" class="message-right">
                        <p>{{ chatMessage.message }}</p>
                    </div>
                    <div v-else class="d-flex">
                        <div class="c-avatar">
                            <img :src="'/storage/img/avatars/' + receive_user_image" class="c-avatar-img">
                            <span class="c-avatar-status bg-success"></span>
                        </div>
                        <div class="message-left">
                            <p class="p-0 m-0">{{ chatMessage.message }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="card-footer d-flex px-2 px-sm-4">
                <div class="pt-1 mr-2">
                    <button class="btn btn-sm btn-outline-danger btn-image" style="">
                        <svg class="c-icon">
                            <use xlink:href="/assets/coreui.icon.svg#cil-smile"></use>
                        </svg>
                    </button>
                </div>
                <div class="pt-1 mr-2">
                    <button class="btn btn-sm btn-outline-success">
                        <svg class="c-icon">
                            <use xlink:href="/assets/coreui.icon.svg#cil-satelite"></use>
                        </svg>
                    </button>
                </div>
                <ValidationObserver ref="observer" v-slot="{ invalid }" class="w-100">
                <form v-on:submit.prevent="sendChatMessage">
                    <div class="input-group">
                        <ValidationProvider name="メッセージ" rules="required|max:1000" style="width: calc(100% - 60px)">
                            <input v-model="inputChatMessage" type="text" placeholder="Message" class="form-control" autofocus>
                        </ValidationProvider>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary" :disabled="invalid">Send</button>
                        </div>
                    </div>
                </form>
                </ValidationObserver>
            </footer>
        </div>
    </div>
</div>

</template>

<script>
import '../../plugin/validate.js';

export default {
    computed: {
        inputChatMessage: {
            get () {
                return this.input_chat_message
            },
            set (value) {
                this.input_chat_message = value
            }
        },
    },
    methods: {
        setReceiveUser: async function() {
            const url = '/api/find/user'
            await axios.get(url, {
                params: {
                    user_id: this.receive_user_id
                }
            }).then ( response => {
                var receiveUser = response.data
                this.receive_user_name = receiveUser.name
                this.receive_user_image = receiveUser.image
            }).catch ( error => {
                if (error.response.status === 401) {
                    this.$router.push({name:'Login'})
                } else {
                    console.log(error)
                }
            })
        },
        getChatMessages: async function() {
            const url = '/api/get/chat/messages'
            await axios.get(url, {
                params: {
                    receive_user_id: this.receive_user_id
                }
            }).then ( response => {
                this.chatMessages = response.data
            }).catch ( error => {
                if (error.response.status === 401) {
                    this.$router.push({name:'Login'})
                } else {
                    console.log(error)
                }
            })
        },
        scrollBottom: function() {
            var cardBody = document.getElementById('card-body');
            cardBody.scrollTop = cardBody.scrollHeight;
        },
        sendChatMessage: async function() {
            const url = '/api/send/chat/message'
            await axios.post(url, {
                params: {
                    receive_user_id: this.receive_user_id,
                    message: this.input_chat_message
                }
            }).then ( response => {
                this.input_chat_message = ''
                this.getChatMessages()
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
        this.setReceiveUser()
        this.getChatMessages()
    },
    updated: function() {
        this.scrollBottom()
    },
    data() {
        return {
            input_chat_message: '',
            send_user_id: this.$store.getters['auth/id'],
            receive_user_id: this.$route.params.receive_user_id,
            receive_user_name: '',
            receive_user_image: '',
            chatMessages: {},
        }
    }
}

</script>

<style scoped>
.card-body {
    height: calc(100vh / 1.8);
    overflow: scroll;
}

.card-body::-webkit-scrollbar {
    display:none;
}

.btn-sm {
    height: 30px;
}

.btn-outline-danger:not(:hover) {
    background-color: rgb(229, 83, 83, 0.1);
}

.btn-outline-success:not(:hover) {
    background-color: rgb(46, 184, 92, 0.1);
}

.message-left {
    display: inline-block;
    position: relative; 
    margin: 5px 0 5px 20px;
    padding: 10px;
    max-width: 250px;
    border-radius: 12px;
    background: #edf1ee;
}

.message-left:after {
    content: "";
    display: inline-block;
    position: absolute;
    top: 3px; 
    left: -19px;
    border: 8px solid transparent;
    border-right: 18px solid #edf1ee;
    -webkit-transform: rotate(35deg);
    transform: rotate(35deg);
}

.message-right {
    margin: 10px 0;
    width: 100%;
    text-align: right;
}

.message-right p {
    display: inline-block;
    position: relative; 
    margin: 0 10px 0 0;
    padding: 8px;
    max-width: 250px;
    border-radius: 12px;
    background: #30e852;
    font-size: 15px;
    text-align: left;
}

.message-right p:after {
    content: "";
    position: absolute;
    top: 3px; 
    right: -19px;
    border: 8px solid transparent;
    border-left: 18px solid #30e852;
    -webkit-transform: rotate(-35deg);
    transform: rotate(-35deg);
}

</style>