<template>
<div>
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-9 col-lg-8">
            <div class="card mb-3">
                <div class="card-body p-3 mx-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <svg class="c-icon">
                                    <use xlink:href="/assets/coreui.icon.svg#cil-magnifying-glass"></use>
                                </svg>
                            </span>
                        </div>
                        <input v-model="userName" class="form-control" type="text" placeholder="ユーザー検索">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-10 col-md-9 col-lg-8">
            <div class="row">
                <div v-for="user in users" :key="user.id" class="col-6 col-sm-4 col-md-3 mb-2">
                    <button class="card btn btn-outline-primary btn-block p-0 m-0"
                            data-toggle="modal" data-target="#add_friend_modal"
                            @click="setFriend(user.id, user.name, user.image)">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <div class="c-avatar">
                                    <img :src="user.image" class="c-avatar-img">
                                    <span class="c-avatar-status bg-success"></span>
                                </div>
                                <div class="pl-2">{{ user.name }}</div>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_friend_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <!-- 友達を追加した後のモーダル画面 -->
        <div v-if="this.add_friend_result" class="modal-dialog">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    {{ this.friend_name }}さんを友達に追加しました。
                </div>
                <div class="modal-body">
                    <h4 class="text-success text-center font-weight-bold mb-0">Thank you Have Completed</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default text-dark" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
        <!-- 友達を追加するモーダル画面 -->
        <div v-else class="modal-dialog">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto" id="myModalLabel">友達を追加しますか？</h5>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="c-avatar">
                            <img :src="friend_user_image" class="c-avatar-img">
                            <span class="c-avatar-status bg-success"></span>
                        </div>
                        <div class="pl-2">{{ friend_name }}</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default text-dark" data-dismiss="modal">閉じる</button>
                    <button type="submit" class="btn btn-primary"
                        @click="addFriend(friend_user_id)">追加する</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import '../../plugin/validate.js';

export default {
    computed: {
        userName: {
            get () {
                this.searchUsers()
                return this.user_name
            },
            set (value) {
                this.user_name = value
            }
        },
    },
    methods: {
        searchUsers: async function() {
            var userName = this.user_name
            const url = '/api/search/users'
            await axios.get(url, {
                params: {
                    user_name: userName,
                    exclude_friends: true,
                }
            }).then ( response => {
                this.users = response.data
            }).catch ( error => {
                if (error.response.status === 401) {
                    this.$router.push({name:'Login'})
                } else {
                    console.log(error)
                }
            })
        },
        setFriend: function(userId, userName, userImage) {
            this.add_friend_result = false
            this.friend_user_id = userId
            this.friend_name = userName
            this.friend_user_image = userImage
        },
        addFriend: async function(friendUserId) {
            console.log(friendUserId)
            const url = '/api/add/friend'
            await axios.post(url, {
                params: {
                    friend_user_id: friendUserId
                }
            }).then ( response => {
                this.add_friend_result = true
                this.searchUsers()
            }).catch ( error => {
                if (error.response.status === 401) {
                    this.$router.push({name:'Login'})
                } else {
                    alert(error.response.data.message)
                    console.log(error)
                }
            })
        }
    },
    data() {
        return {
            user_name: '',
            users: {},
            friend_name: '',
            friend_user_id: '',
            friend_user_image: '',
            add_friend_result: false,
        }
    }
}
</script>

<style scoped>
.btn-outline-primary {
    color: #6c757d;
}
.btn-outline-primary:hover {
    color: #fff;
    font-weight: bold;
}

</style>