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
                            @click="setGiftRecipient(user.id, user.name)">
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

    <div class="modal fade" id="give_point_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <!-- ポイントを贈った後のモーダル画面 -->
        <div v-if="this.gave_point" class="modal-dialog">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    {{ this.gift_recipient_name }}さんへポイントを贈りました。
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
                    <h5 class="modal-title mx-auto" id="myModalLabel">{{ this.gift_recipient_name }}さんへポイントを贈ります。</h5>
                    <div class="pt-1">
                        <label class="small">所持ポイント</label>
                        <span class="badge badge-primary badge-pill mx-1" style="font-size: 12px;">2500</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 col-md-5 offset-md-1 form-group form-row mb-1">
                            <input type="text" class="form-control form-control-sm col-7 text-right px-2" placeholder="200">
                            <label class="col-form-label small col-5 pt-2"> /2500pt</label>
                        </div>
                        <div class="col-6 col-md-5 form-check pt-1 mb-1">
                            <input id="anonymity" type="checkbox" class="form-check-input" checked>
                            <label for="anonymity" class="form-check-label">贈り相手に名前を表示</label>
                        </div>
                        <div class="form-group col-12 col-md-10 offset-md-1 mb-1">
                            <label class="col-form-label">メッセージを添える</label>
                            <textarea type="text" rows="2" class="form-control form-control-sm" placeholder="お風呂掃除ありがとう！">
                        </textarea>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default text-dark" data-dismiss="modal">閉じる</button>
                    <button type="button" class="btn btn-primary" @click="givePoint()">贈る</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
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
                console.log('通過1')
                var url = 'api/search/users'
            } else {
                console.log('通過2')
                var url = 'api/search/users'
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
        setGiftRecipient: async function(userId, userName) {
            this.gave_point = false
            this.gift_recipient_id = userId
            this.gift_recipient_name = userName
        },
        givePoint: async function() {
            console.log(this.gift_recipient_id)

            this.gave_point = true
        }
    },
    data() {
        return {
            user_name: '',
            fliend_only: true,
            users: {},
            gift_recipient_id: '',
            gift_recipient_name: '',
            gave_point: false,
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