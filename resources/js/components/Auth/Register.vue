<template>
<div class="c-wrapper c-fixed-components">
<div class="c-body">
<main class="c-main">
<div class="container fade-in">

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card mx-sm-4">
            <ValidationObserver ref="observer" v-slot="{ invalid }">
            <form v-on:submit.prevent="register">
                <div class="card-body p-4">
                    <h1>会員登録</h1>
                    <div class="row">
                        <div class="col-6">
                            <p class="text-muted">Create your account</p>
                        </div>
                        <div class="col-6 text-center">
                            <router-link to="/login" class="h5 font-weight-bold">サインイン</router-link>
                        </div>
                    </div>

                    <ValidationProvider name="名前" rules="required|max:100" v-slot="{ errors }">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="/assets/coreui.icon.svg#cil-user"></use>
                                    </svg>
                                </span>
                            </div>
                            <input class="form-control" type="text" v-model="user.name" placeholder="User Name">
                        </div>
                        <div class="text-danger p-1 mb-2">{{ errors[0] }}</div>
                    </ValidationProvider>

                    <ValidationProvider name="メールアドレス" rules="required|email|max:100" v-slot="{ errors }">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="/assets/coreui.icon.svg#cil-envelope-closed"></use>
                                    </svg>
                                </span>
                            </div>
                            <input class="form-control" type="text" v-model="user.email" placeholder="Email">
                        </div>
                        <div class="text-danger p-1 mb-2">{{ errors[0] }}</div>
                    </ValidationProvider>

                    <ValidationProvider name="パスワード" rules="required|alpha_dash|min:6|max:100" vid="password" v-slot="{ errors }">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="/assets/coreui.icon.svg#cil-lock-locked"></use>
                                    </svg>
                                </span>
                            </div>
                            <input class="form-control" type="password" name="password" v-model="user.password" placeholder="Password">
                        </div>
                        <div class="text-danger p-1 mb-2">{{ errors[0] }}</div>
                    </ValidationProvider>

                    <ValidationProvider name="確認用パスワード" rules="required|confirmed:password" v-slot="{ errors }">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="/assets/coreui.icon.svg#cil-lock-locked"></use>
                                    </svg>
                                </span>
                            </div>
                            <input class="form-control" type="password" v-model="user.password_confirmation" placeholder="Repeat password">
                        </div>
                        <div class="text-danger p-1 mb-2">{{ errors[0] }}</div>
                    </ValidationProvider>
                    
                    <button class="btn btn-block btn-success" type="submit" :disabled="invalid">登録</button>
                    <div v-if="register_failed" class="text-danger font-weight-bold p-1">
                        会員登録に失敗しました。
                    </div>
                </div>
            </form>
            </ValidationObserver>
            <div class="card-footer p-4">
                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-block btn-facebook" type="button">
                            <span>facebook</span>
                        </button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-block btn-twitter" type="button">
                            <span>twitter</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</main>
</div>
</div>
</template>

<script>

export default {
    methods: {
        register: async function() {
            await this.$store.dispatch('auth/logout')
            var result = await this.$store.dispatch('auth/register', this.user)
            if (result) {
                this.$router.push('/')
            } else {
                this.register_failed = true
            }
        },
    },
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            },
            register_failed: false
        }
    },
}
</script>