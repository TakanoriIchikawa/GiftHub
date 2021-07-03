<template>
<div>
    <div class="row justify-content-center">
        <div class="col-12 col-md-11 col-lg-10">
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
                        <input v-model="friendName" class="form-control" type="text" placeholder="Search Friend">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-11 col-lg-10">
            <div class="row">
                <div v-for="friend in friends" :key="friend.id" class="col-12 col-sm-6 col-md-4 col-lg-3 col-md-4 mb-2 mb-sm-3">
                    <div class="card w-100 p-0 m-0">
                        <div class="card-body p-2 w-100">
                            <div class="d-flex justify-content-between mx-3 mx-lg-0">
                                <div class="d-flex align-items-center">
                                    <div class="c-avatar">
                                        <img :src="friend.user.image" class="c-avatar-img">
                                        <span class="c-avatar-status bg-success"></span>
                                    </div>
                                    <div class="pl-2">{{ friend.user.name }}</div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-success badge-pill py-1 px-2">{{ friend.sum_give_points.toLocaleString() }}</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mx-3 mx-lg-0 pl-1 mt-2">
                                <div class="d-flex pt-1">
                                    <svg class="c-icon">
                                        <use xlink:href="/assets/coreui.icon.svg#cil-birthday-cake"></use>
                                    </svg>
                                    <span class="ml-2">{{ friend.user.birth_month }}月{{ friend.user.birth_day }}日</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-sm btn-primary btn-pill"
                                        data-toggle="modal" data-target="#give_point_modal"
                                        @click="givePointEvent(friend.user.id, friend.user.name, friend.user.image)">
                                        <svg class="c-icon d-flex align-items-center">
                                            <use xlink:href="/assets/coreui.icon.svg#cil-smile"></use>
                                        </svg>
                                    </button>
                                    <router-link :to="{ name:'ChatRoom', params: { receive_user_id: friend.user.id}}">
                                    <button type="button" class="btn btn-sm btn-danger ml-2">
                                        <svg class="c-icon d-flex align-items-center">
                                            <use xlink:href="/assets/coreui.icon.svg#cil-chat-bubble"></use>
                                        </svg>
                                    </button>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 友達追加 -->
    <router-link :to="{ name:'FriendAdd' }">
        <button class="btn btn-primary btn-add-friend">
            <svg class="icon-add-friend" width="200px" height="200px">
                <use xlink:href="/assets/coreui.icon.svg#cil-user-follow"></use>
            </svg>
        </button>
    </router-link>

    <give-point @searchFriends="searchFriends" ref="givePoint"></give-point>

</div>
</template>

<script>
import GivePoint from '../Point/GivePoint'

export default {
    components: {
        'give-point': GivePoint
    },
    computed: {
        friendName: {
            get () {
                this.searchFriends()
                return this.friend_name
            },
            set (value) {
                this.friend_name = value
            }
        },
    },
    methods: {
        searchFriends: async function() {
            var friendName = this.friend_name
            const url = '/api/search/friends'
            await axios.get(url, {
                params: {
                    friend_name: friendName
                }
            }).then ( response => {
                this.friends = response.data
                // 友達がいない場合は追加画面へ
                if (!Object.keys(this.friends).length) {
                    this.$router.push({name:'FriendAdd'})
                } 
            }).catch ( error => {
                if (error.response.status === 401) {
                    this.$router.push({name:'Login'})
                } else {
                    console.log(error)
                }
            })
        },
        givePointEvent: function(friendUserId, friendName, friendImage) {
            this.$refs.givePoint.getAvailablePoint()
            this.$refs.givePoint.setReceive(friendUserId, friendName, friendImage)
        },
    },
    data() {
        return {
            friend_name: '',
            friends: {},
        }
    }
}
</script>

<style scoped>

.btn-add-friend {
    position: fixed;
    border-radius: 50%;
    height: 90px;
    width: 90px;
    font-size: 22px;
    bottom: 6%; 
    right: 3%;
}

.icon-add-friend {
    height: 42px;
    width: 42px;
    margin-left: 5px;
}

@media screen and (max-width:768px) {
    .btn-add-friend {
        height: 70px;
        width: 70px;
        font-size: 14px;
        bottom: 3%; 
    }

    .icon-add-friend {
    height: 32px;
    width: 32px;
    margin-left: 3px;
}
}

</style>