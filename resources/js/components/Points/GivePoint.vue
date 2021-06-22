<template>
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
                    <div class="modal-title d-flex align-items-center justify-content-center mx-auto">
                        <div class="c-avatar">
                            <img :src="'/assets/img/avatars/' + receive_user_image" class="c-avatar-img">
                            <span class="c-avatar-status bg-success"></span>
                        </div>
                        <div class="pl-2">{{ receive_name }}さんへポイントを贈ります。</div>
                    </div>
                    <div class="pt-2">
                        <label class="small">所持ポイント</label>
                        <span class="badge badge-primary badge-pill pt-1 mx-1" style="font-size: 14px;">{{ available_point.toLocaleString() }}</span>
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
                                    <label class="col-form-label small px-1 mr-sm-3"> /{{ available_point.toLocaleString() }}pt</label>
                                </div>
                                <div class="text-danger p-1">{{ errors[0] }}</div>
                                </ValidationProvider>
                            </div>

                            <div class="col-5 form-check pt-1 mb-1">
                                <div class="input-group">
                                    <input id="signature" type="checkbox" v-model="signature" class="form-check-input" checked>
                                    <label for="signature" class="form-check-label">相手に通知する</label>
                                </div>
                            </div>

                            <div class="form-group col-12 col-sm-10 offset-sm-1 mb-1">
                                <ValidationProvider name="メッセージ" rules="max:30" v-slot="{ errors }">
                                <div class="">
                                    <label class="col-form-label">メッセージを添える</label>
                                    <textarea type="text" v-model="message" rows="2" class="form-control form-control-sm" placeholder="いつもありがとう！"></textarea>
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
</template>

<script>
import '../../plugin/validate.js';

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
        setReceive: function(userId, userName, userImage) {
            this.give_point_result = false
            this.receive_user_id = userId
            this.receive_name = userName
            this.receive_user_image = userImage
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
                this.give_point_result = true
                this.$emit('searchFriends')
            }).catch ( error => {
                var httpStatusCode = error.response.status
                if (httpStatusCode === 401) {
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
            available_point: 0,
            receive_name: '',
            receive_user_id: '',
            receive_user_image: '',
            give_point: 10,
            signature: true,
            message: '',
            give_point_result: false,
        }
    }
}


</script>
