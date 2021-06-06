<template>
<div>
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-9 col-lg-8">
            <div class="card mb-3">
                <div class="card-body p-3 mx-2">
                    <div class="row">
                        <div class="input-group col-12 col-sm-9">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="/assets/coreui.icon.svg#cil-user"></use>
                                    </svg>
                                </span>
                            </div>
                            <input v-model="userName" class="form-control" type="text" placeholder="Search User">
                        </div>
                        <div class="input-group form-check col-11 offset-1 col-sm-3 offset-sm-0 pt-2">
                            <input v-model="frinedOnly" id="friend_only" type="checkbox" class="form-check-input" checked>
                            <label for="friend_only" class="form-check-label">お友達のみ</label>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-sm-10 col-md-9 col-lg-8">
            <div class="row">
                <div v-for="user in users" :key="user.id" class="col-6 col-sm-4 col-md-3 mb-2">
                    <button class="card btn btn-outline-primary btn-block p-0 m-0"
                            data-toggle="modal" data-target="#give_point_modal"
                            @click="getAvailablePoint(); setReceive(user.id, user.name)">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <div class="c-avatar">
                                    <img src="/assets/img/avatars/3.jpg" class="c-avatar-img">
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
    <!-- ポイントチャージのリンク -->
    <router-link :to="{ name:'Grant' }">
        <button class="btn btn-danger">
            <svg class="c-icon">
                <use xlink:href="/assets/coreui.icon.svg#cil-plus"></use>
            </svg>
            <span class="font-weight-bold">PT</span>
        </button>
    </router-link>

    <div class="modal fade" id="give_point_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <!-- ポイントを贈った後のモーダル画面 -->
        <div v-if="this.give_point_result" class="modal-dialog">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    {{ this.receive_name }}さんへポイントを贈りました。
                </div>
                <div class="modal-body">
                    <h4 class="text-success text-center font-weight-bold mb-0">Thank you Have Completed</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default text-dark" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
        <!-- ポイントを贈るモーダル画面 -->
        <div v-else class="modal-dialog">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto" id="myModalLabel">{{ receive_name }}さんへポイントを贈ります。</h5>
                    <div class="pt-1">
                        <label class="small">所持ポイント</label>
                        <span class="badge badge-primary badge-pill pt-1 mx-1" style="font-size: 14px;">{{ available_point }}</span>
                    </div>
                </div>
                <ValidationObserver ref="observer" v-slot="{ invalid }">
                <form v-on:submit.prevent="checkAvailablePoint">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-7 col-sm-6 offset-sm-1 form-group form-row mb-1">
                                <ValidationProvider name="ポイント" rules="required|min_value:1|max_value:1000" v-slot="{ errors }">
                                <div class="input-group">
                                    <input type="text" v-model="give_point" class="form-control form-control-sm text-right" placeholder="0">
                                    <label class="col-form-label small px-1 mr-sm-3"> /{{ available_point }}pt</label>
                                </div>
                                <div class="text-danger p-1">{{ errors[0] }}</div>
                                </ValidationProvider>
                            </div>

                            <div class="col-5 form-check pt-1 mb-1">
                                <div class="input-group">
                                    <input id="signature" type="checkbox" v-model="signature" class="form-check-input" checked>
                                    <label for="signature" class="form-check-label">相手に名前を表示</label>
                                </div>
                            </div>

                            <div class="form-group col-12 col-sm-10 offset-sm-1 mb-1">
                                <ValidationProvider name="メッセージ" rules="max:30" v-slot="{ errors }">
                                <div class="">
                                    <label class="col-form-label">メッセージを添える</label>
                                    <textarea type="text" v-model="message" rows="2" class="form-control form-control-sm" placeholder="お風呂掃除ありがとう！"></textarea>
                                </div>
                                <div class="text-danger p-1">{{ errors[0] }}</div>
                                </ValidationProvider>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default text-dark" data-dismiss="modal">閉じる</button>
                        <button type="submit" class="btn btn-primary" :disabled="invalid">贈る</button>
                    </div>
                </form>
                </ValidationObserver>
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
        frinedOnly: {
            get () {
                this.searchUsers()
                return this.fliend_only
            },
            set (value) {
                this.fliend_only = value
            }
        }
    },
    methods: {
        searchUsers: async function() {
            var userName = this.user_name
            if (this.fliend_only) {
                var url = '/api/search/users'
            } else {
                var url = '/api/search/users'
            }
            await axios.get(url, {
                params: {
                    user_name: userName
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
        getAvailablePoint: async function() {
            const url = '/api/get/available-point'
            await axios.get(url)
            .then ( response => {
                this.available_point = response.data
            }).catch ( error => {
                if (error.response.status === 401) {
                    this.$router.push({name:'Login'})
                } else {
                    console.log(error)
                }
            })
        },
        setReceive: function(userId, userName) {
            this.give_point_result = false
            this.receive_name = userName
            this.receive_user_id = userId
            this.give_point = 10
            this.signature = true
            this.message = ''
        },
        checkAvailablePoint: function() {
            if (this.give_point <= this.available_point) {
                this.givePoint()
            } else {
                alert('ポイントが不足しています。ポイントをチャージしてください。')
            }
        },
        givePoint: async function() {
            const url = '/api/give/point'
            await axios.post(url, {
                params: {
                    receive_user_id: this.receive_user_id,
                    give_point: this.give_point,
                    signature: this.signature,
                    message: this.message,
                }
            })
            .then (response => {
                console.log(response.status)
                this.give_point_result = true
            }).catch ( error => {
                var httpStatusCode = error.response.status
                if (httpStatusCode === 401) {
                    this.$router.push({name:'Login'})
                } else if (httpStatusCode === 422 || httpStatusCode === 500) {
                    alert(error.response.data.message)
                } else {
                    console.log(error)
                }
            })
        }
    },
    data() {
        return {
            available_point: 0,
            fliend_only: true,
            user_name: '',
            users: {},
            receive_name: '',
            receive_user_id: '',
            give_point: 10,
            signature: true,
            message: '',
            give_point_result: false,
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

.btn-danger {
    position: fixed;
    border-radius: 50%;
    height: 90px;
    width: 90px;
    font-size: 22px;
    bottom: 6%; 
    right: 5%;
}

@media screen and (max-width:768px) {
    .btn-danger {
        height: 70px;
        width: 70px;
        font-size: 14px;
        bottom: 3%; 
        right: 3%;
    }
}

</style>