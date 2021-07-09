<template>

<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8">
        <div class="card mx-sm-4">
            <header class="card-header">
                <svg class="c-icon">
                    <use xlink:href="/assets/coreui.icon.svg#cil-envelope-open"></use>
                </svg>
                <strong class="px-2"> お問い合わせ </strong>
            </header>
            <ValidationObserver ref="observer" v-slot="{ invalid }">
            <form v-on:submit.prevent="sendMail">
                <div class="card-body p-3 p-sm-4">
                    <ValidationProvider name="企業名" rules="max:100" v-slot="{ errors }">
                        <div class="form-group form-row mb-1">
                            <label for="company" class="col-form-label col-12 col-sm-3 text-sm-right"> 企業名 </label>
                            <div class="col-sm-8">
                                <input id="company" v-model="params.company" type="text" class="form-control" placeholder="株式会社〇〇">
                            </div>
                        </div>
                        <div class="col-12 col-sm-8 offset-sm-3 text-danger p-1">{{ errors[0] }}</div>
                    </ValidationProvider>

                    <ValidationProvider name="名前" rules="required|max:100" v-slot="{ errors }">
                        <div class="form-group form-row mb-1">
                            <label for="name" class="col-form-label col-sm-3 text-sm-right"> 名前</label>
                            <div class="col-sm-8">
                                <input id="name" v-model="params.name" type="text" class="form-control" placeholder="市川千耀">
                            </div>
                        </div>
                        <div class="col-12 col-sm-8 offset-sm-3 text-danger p-1">{{ errors[0] }}</div>
                    </ValidationProvider>

                    <ValidationProvider name="メールアドレス" rules="required|email|max:100" v-slot="{ errors }">
                        <div class="form-group form-row mb-1">
                            <label for="email" class="col-form-label col-sm-3 text-sm-right"> メールアドレス</label>
                            <div class="col-sm-8">
                                <input id="email" v-model="params.email" type="text" class="form-control" placeholder="chiaki0223@test.com">
                            </div>
                        </div>
                        <div class="col-12 col-sm-8 offset-sm-3 text-danger p-1">{{ errors[0] }}</div>
                    </ValidationProvider>

                    <ValidationProvider name="電話番号" rules="numeric" v-slot="{ errors }">
                        <div class="form-group form-row mb-1">
                            <label for="telephone" class="col-form-label col-sm-3 text-sm-right"> 電話番号</label>
                            <div class="col-sm-8">
                                <input id="telephone" v-model="params.telephone" type="text" class="form-control" placeholder="09020200223">
                            </div>
                        </div>
                        <div class="col-12 col-sm-8 offset-sm-3 text-danger p-1">{{ errors[0] }}</div>
                    </ValidationProvider>

                    <div class="form-row form-group">
                        <div class="col-sm-3 text-sm-right"> ご用件</div>
                        <div class="col-sm-8">
                            <div class="custom-control custom-radio ml-2">
                                <input id="requirement1" type="radio" v-model="params.requirement" class="custom-control-input" value="スカウト（正社員）">
                                <label for="requirement1" class="custom-control-label"> スカウト（正社員） </label>
                            </div>
                            <div class="custom-control custom-radio ml-2">
                                <input id="requirement2" type="radio" v-model="params.requirement" class="custom-control-input" value="スカウト（業務委託）">
                                  <label for="requirement2" class="custom-control-label"> スカウト（業務委託） </label>
                            </div>
                            <div class="custom-control custom-radio ml-2">
                                <input id="requirement3" type="radio" v-model="params.requirement" class="custom-control-input" value="その他">
                                <label for="requirement3" class="custom-control-label"> その他 </label>
                            </div>
                        </div>
                    </div>

                    <ValidationProvider name="内容" rules="max:1000" v-slot="{ errors }">
                        <div class="form-group form-row mb-1">
                            <label for="contents" class="col-form-label col-sm-3 text-sm-right"> 内容</label>
                            <div class="col-sm-8">
                                <textarea id="contents" v-model="params.contents" type="text" rows="6" class="form-control" placeholder="スカウト条件とかWebアプリの感想とか書いてください"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-sm-8 offset-sm-3 text-danger p-1">{{ errors[0] }}</div>
                    </ValidationProvider>
                  
                    <button class="col-12 col-sm-10 offset-sm-1 btn btn-block btn-success mt-1" type="submit" :disabled="invalid">送信</button>
                </div>
            </form>
            </ValidationObserver>
        </div>
    </div>
</div>


</template>

<script>

export default {
    methods: {
        sendMail: async function() {
            const url = '/api/send/mail'
            await axios.post(url, {
                params: this.params
            })
            .then (response => {
                alert('問い合わせが完了しました。')
            }).catch ( error => {
                var httpStatusCode = error.response.status
                if (httpStatusCode === 401) {
                    this.$router.push({name:'Login'})
                } else {
                    console.log(error)
                }
            })
        },
    },
    data() {
        return {
            params: {
                title: 'GiftHubからのお問い合わせ',
                company: '',
                name: '',
                email: '',
                telephone: '',
                requirement: 'スカウト（正社員）',
                contents: '',
            }
        }
    },
}
</script>