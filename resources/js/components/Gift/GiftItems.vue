<template>

<div class="row">
    <div v-for="item in giftItems" :key="item.id" class="col-sm-6 col-md-3">
        <button class="card btn p-0"
            data-toggle="modal" data-target="#exchange_point_modal"
            @click="setExchangeGiftItem(item.id, item.name, item.point, item.image)">
            <header class="card-header w-100 d-flex justify-content-between align-items-center">
                <span>{{ item.name }}</span> 
                <span class="badge badge-success badge-pill py-1">{{ item.point.toLocaleString() }}</span>
            </header>
            <div class="card-body">
                <img :src="item.image" class="d-block img-fluid">
            </div>
        </button>
    </div>

    <div class="modal fade" id="exchange_point_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <!-- ポイントを贈った後のモーダル画面 -->
        <div v-if="this.exchange_point_result" class="modal-dialog">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="m-0">
                        <small>ポイントを交換しました。</small>
                    </h5>
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
                        <small>ポイントを交換しますか？</small>
                    </h5>
                    <div>
                        <small>必要ポイント</small>
                        <span class="badge badge-success badge-pill pt-1 ml-1 mr-sm-1" style="font-size: 14px;">{{ exchange_gift_item_point.toLocaleString() }}</span>
                    </div>
                </div>
                <form v-on:submit.prevent="checkExchangeablePoint">
                    <div class="modal-body">
                        <h4 class="text-center">{{ exchange_gift_item_name }}</h4>
                        <div class="px-5">
                            <img :src="exchange_gift_item_image" class="d-block img-fluid">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between align-items-center">
                        <div>
                            <small>交換可能ポイント</small>
                            <span class="text-danger font-weight-bold h5">{{ exchangeable_point.toLocaleString() }}</span>
                        </div>
                        <div>
                            <button type="button" class="btn btn-default text-dark" data-dismiss="modal">閉じる</button>
                            <button type="submit" class="btn btn-success font-weight-bold">交換</button>
                        </div>
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
        getGiftItems: async function() {
            const giftCategoryId = this.$route.params.gift_category_id
            const url = '/api/get/gift/items'
            await axios.get(url, {
                params: {
                    gift_category_id: giftCategoryId
                }
            })
            .then ( response => {
                this.giftItems = response.data
            }).catch ( error => {
                if (error.response.status === 401) {
                    this.$router.push({name:'Login'})
                } else {
                    console.log(error)
                }
            })
        },
        checkExchangeablePoint: function() {
            if (this.exchange_gift_item_point <= this.exchangeable_point) {
                this.exchangePoint()
            } else {
                alert('ポイントが不足しています。')
            }
        },
        exchangePoint: async function() {
            const url = '/api/exchange/point'
            await axios.post(url, {
                params: {
                    gift_item_id: this.exchange_gift_item_id,
                    exchange_point: this.exchange_gift_item_point,
                }
            })
            .then ( response => {
                this.exchange_point_result = true
            }).catch ( error => {
                if (error.response.status === 401) {
                    this.$router.push({name:'Login'})
                } else {
                    alert(error.response.data.message)
                    console.log(error)
                }
            })
        },
        getExchangeablePoint: async function() {
            const url = '/api/get/exchangeable-point'
            await axios.get(url)
            .then ( response => {
                this.exchangeable_point = response.data
            }).catch ( error => {
                if (error.response.status === 401) {
                    this.$router.push({name:'Login'})
                } else {
                    console.log(error)
                }
            })
        },
        setExchangeGiftItem: function($giftItemId, $giftItemName, $giftItemPoint, $giftItemImage) {
            this.exchange_point_result = false
            this.getExchangeablePoint()
            this.exchange_gift_item_id = $giftItemId
            this.exchange_gift_item_name = $giftItemName
            this.exchange_gift_item_point = $giftItemPoint
            this.exchange_gift_item_image = $giftItemImage
        }
    },
    mounted() {
        this.getGiftItems()
    },
    data() {
        return {
            giftItems: {},
            exchange_point_result: false,
            exchange_gift_item_id: '',
            exchange_gift_item_name: '',
            exchange_gift_item_point: '',
            exchange_gift_item_image: '',
            exchangeable_point: '',
        }
    }
}

</script>

<style scoped>

a {
    text-decoration: none;
}

.fs-18 {
    font-size: 18px;
}

img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    transition:1s all;
}

</style>