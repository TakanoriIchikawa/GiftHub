<template>
<div>
    <div class="row">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-primary text-center font-weight-bold m-0">
                        <span>友達に贈れるポイント</span>
                    </h5>
                </div>
                <div class="card-body">
                    <h1 class="text-primary text-center font-weight-bold py-3 m-0">
                        {{ points.available_point.toLocaleString() }}
                        <small>pt</small>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-info text-center font-weight-bold m-0">
                        <span>今まで贈ったポイント</span>
                    </h5>
                </div>
                <div class="card-body">
                    <h1 class="text-info text-center font-weight-bold py-3 m-0">
                        {{ points.gave_point.toLocaleString() }}
                        <small>pt</small>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-success text-center font-weight-bold m-0">
                        <span>今まで貰ったポイント</span>
                    </h5>
                </div>
                <div class="card-body">
                    <h1 class="text-success text-center font-weight-bold py-3 m-0">
                        {{ points.received_point.toLocaleString() }}
                        <small>pt</small>
                    </h1>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-danger text-center font-weight-bold m-0">
                        <span>景品と交換可能なポイント</span>
                    </h5>
                </div>
                <div class="card-body">
                    <h1 class="text-danger text-center font-weight-bold py-3 m-0">
                        {{ points.exchangeable_point.toLocaleString() }}
                        <small>pt</small>
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card">
                <header class="card-header">
                    最近ポイントを贈った友達
                </header>
                <div class="card-body">
                    <div class="position-relative table-responsive">
                        <table class="table mb-0">
                            <tbody class="position-relative">
                                <router-link  v-for="friend in list.give_point_friends" :key="friend.id"
                                            :to="{ path:'/chat/room/' + friend.receive_user_id }"
                                            class="text-decoration-none">
                                    <tr class="d-flex">
                                        <td class="w-100 d-flex align-items-center">
                                            <div class="c-avatar">
                                                <img :src="friend.receive_point_user.image" class="c-avatar-img">
                                                <span class="c-avatar-status bg-success"></span>
                                            </div>
                                            <div class="pl-3 text-dark">
                                                <strong>{{ friend.receive_point_user.name }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary p-2 my-2 text-right" style="width: 55px;">
                                                {{ friend.give_point.toLocaleString() }}
                                                <small>pt</small>
                                            </span>
                                        </td>
                                    </tr>
                                </router-link>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card">
                <header class="card-header">
                    最近ポイントを貰った友達
                </header>
                <div class="card-body">
                    <div class="position-relative table-responsive">
                        <table class="table mb-0">
                            <tbody class="position-relative">
                                <router-link v-for="friend in list.receive_point_friends" :key="friend.id"
                                            :to="{ path:'/chat/room/' + friend.give_user_id }"
                                            class="text-decoration-none">
                                    <tr class="d-flex">
                                        <td class="w-100 d-flex align-items-center">
                                            <div class="c-avatar">
                                                <img :src="friend.give_point_user.image" class="c-avatar-img">
                                                <span class="c-avatar-status bg-success"></span>
                                            </div>
                                            <div class="pl-3 text-dark">
                                                <strong>{{ friend.give_point_user.name }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-success p-2 my-2" style="width: 55px;">
                                                {{ friend.give_point.toLocaleString() }}
                                                <small>pt</small>
                                            </span>
                                        </td>
                                    </tr>
                                </router-link>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card">
                <header class="card-header">
                    最近交換した景品
                </header>
                <div class="card-body">
                    <div class="position-relative table-responsive">
                        <table class="table mb-0">
                            <tbody class="position-relative">
                                <router-link v-for="gift in list.exchange_gift_items" :key="gift.id"
                                            :to="{ path:'/gift/item/' + gift.gift_item.gift_category_id }"
                                            class="text-decoration-none">
                                    <tr class="d-flex">
                                        <td class="w-100 d-flex align-items-center">
                                            <div class="c-avatar">
                                                <img :src="gift.gift_item.image" class="c-avatar-img">
                                            </div>
                                            <div class="pl-3 text-dark">
                                                <strong>{{ gift.gift_item.name }}</strong>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-danger p-2 my-2" style="width: 55px;">
                                                {{ gift.exchange_point.toLocaleString() }}
                                                <small>pt</small>
                                            </span>
                                        </td>
                                    </tr>
                                </router-link>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
    },
    mounted() {
        this.getDashboardData()
    },
    data() {
        return {
            points: {},
            list: {},
        }
    }
}

</script>


</script>

<style scoped>

.text-decoration-none:hover {
    text-decoration: none;
}
</style>
