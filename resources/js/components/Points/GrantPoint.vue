<template>

<div class="row mt-md-3 mt-lg-3">
    <div v-for="item in data" :key="item.id" class="col-12 col-sm-6 col-lg-3 mb-4">
        <button class="card btn p-0 m-0 w-100"
            data-toggle="modal" data-target="#grant_point_modal"
            @click="setGrantPoint(item.point, item.price, item.color)">
            <div class="card-header d-flex align-items-center w-100 p-0">
                <div class="text-white w-50 py-2 text-center" :class="'bg-gradient-' + item.color">
                    <h3 class="font-weight-bold m-1">
                        <span>{{ item.point.toLocaleString() }}</span>
                        <small>pt</small>
                    </h3>
                </div>
                <div class="w-50 py-2 text-center">
                    <h3 class="font-weight-bold m-1" :class="'text-' + item.color">
                        <small>¥</small>
                        <span>{{ item.price.toLocaleString() }}</span>
                    </h3>
                </div>
            </div>
            <div class="card-body w-100">
                <div class="text-center">
                    <h4 class="m-0" :class="'text-' + item.color">
                        <small>割引率</small>
                        <span class="h2 font-weight-bold px-1">{{ item.discount }}</span>
                        <small>%</small>
                    </h4>
                </div>
                <div class="progress-xs my-3 mb-0 progress">
                    <div role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" class="progress-bar" :class="'bg-gradient-' + item.color" :style="'width:' + item.discount + '%;'"></div>
                </div>
                <small class="text-muted">Give points and say thank you</small>
            </div>
        </button>
    </div>

    <div class="modal fade" id="grant_point_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <!-- ポイントを贈った後のモーダル画面 -->
        <div v-if="this.grant_point_result" class="modal-dialog">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="m-0">
                        <small>ポイントを購入しました。</small>
                    </h5>
                    <div>
                        <small>贈れるポイント</small>
                        <span class="badge badge-primary badge-pill pt-1 ml-1 mr-sm-1" style="font-size: 14px;">{{ available_point.toLocaleString() }}</span>
                    </div>
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
                    <h5 class="m-0">
                        <span>{{ grant_point.toLocaleString() }}</span>
                        <small>ptを購入しますか？</small>
                    </h5>
                    <div>
                        <small>贈れるポイント</small>
                        <span class="badge badge-primary badge-pill pt-1 mx-1" style="font-size: 14px;">{{ available_point.toLocaleString() }}</span>
                    </div>
                </div>
                <form v-on:submit.prevent="grantPoint">
                    <div class="modal-body">
                        <h1 class="text-center font-weight-bold mb-1" :class="color">
                            <span>{{ this.price.toLocaleString() }}</span>
                            <small>円</small>
                        </h1>
                        <h5 class="text-center m-0">
                            <small>※ポイントの有効期限は2ヶ月です。</small>
                        </h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default text-dark" data-dismiss="modal">閉じる</button>
                        <button type="submit" class="btn btn-primary">購入</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

</template>

<script>

export default {
    methods: {
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
        grantPoint: async function() {
            const url = '/api/charge/grant-point'
            await axios.post(url, {
                params: {
                    grant_point: this.grant_point,
                    price: this.price,
                }
            })
            .then (response => {
                this.available_point = response.data
                this.grant_point_result = true
            }).catch ( error => {
                var httpStatusCode = error.response.status
                if (httpStatusCode === 401) {
                    this.$router.push({name:'Login'})
                } else {
                    alert(error.response.data.message)
                    console.log(error)
                }
            })
        },
        setGrantPoint: function(grantPoint, price, color) {
            this.getAvailablePoint()
            this.grant_point_result = false
            this.grant_point = grantPoint
            this.price = price
            this.color = 'text-' + color
        },
    },
    data() {
        return {
            available_point: 0,
            grant_point: 0,
            price: 0,
            color: '',
            grant_point_result: false,
            data: {
                primary: { 
                    point: 1000,
                    price: 1000,
                    discount: 0,
                    color: 'primary'
                },
                success: {
                    point: 3000,
                    price: 2550,
                    discount: 15,
                    color: 'success'
                },
                warning: {
                    point: 5000,
                    price: 3500,
                    discount: 30,
                    color: 'warning'
                },
                dabger: {
                    point: 10000,
                    price: 5500,
                    discount: 45,
                    color: 'danger'
                },
            }
        }
    }
}
</script>
