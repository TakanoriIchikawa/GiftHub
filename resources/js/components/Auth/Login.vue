<template>
<div class="c-wrapper c-fixed-components">
<div class="c-body">
<main class="c-main">
<div class="container fade-in">

<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card-group">
            <div class="card p-4">
                <ValidationObserver ref="observer" v-slot="{ invalid }">
                <form v-on:submit.prevent="loginここここここ">
                    <div class="card-body">
                        <h1>ログインわわわわわあ</h1>
                        <p class="text-muted">Sign In to your account</p>

                        <ValidationProvider name="メールアドレス" rules="required" v-slot="{ errors }">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="assets/coreui.icon.svg#cil-envelope-closed"></use>
                                    </svg>
                                </span>
                            </div>
                            <input class="form-control" v-model="user.email" type="text" placeholder="Email">
                        </div>
                        <div class="text-danger p-1 mb-3">{{ errors[0] }}</div>
                        </ValidationProvider>

                        <ValidationProvider name="パスワード" rules="required" v-slot="{ errors }">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="assets/coreui.icon.svg#cil-lock-locked"></use>
                                    </svg>
                                </span>
                            </div>
                            <input class="form-control" v-model="user.password" type="password" placeholder="Password">
                        </div>
                        <div class="text-danger p-1 mb-4">{{ errors[0] }}</div>
                        </ValidationProvider>
                        
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary px-4" type="submit" :disabled="invalid">ログイン</button>
                            </div>
                            <div class="col-6 text-right">
                                <button class="btn btn-link px-0" type="button">Forgot password?</button>
                            </div>
                        </div>
                        <div v-if="login_failed" class="text-danger font-weight-bold p-1">
                            ユーザーIDまたはパスワードを確認してください。
                        </div>
                    </div>
                </form>
                </ValidationObserver>
            </div>
            <div class="card text-white bg-primary py-5 d-none d-md-block" style="width:44%">
                <div class="card-body text-center">
                    <div>
                        <h2>サインアップ</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <router-link to="/register">
                            <button class="btn btn-lg btn-outline-light mt-3" type="button">会員登録</button>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card text-white bg-primary py-5 d-md-none">
            <div class="card-body text-center">
                <div>
                    <h2>サインアップ</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <router-link to="/register">
                        <button class="btn btn-lg btn-outline-light mt-3" type="button">会員登録</button>
                    </router-link>
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
        login: async function() {
            await this.$store.dispatch('auth/logout')
            var result = await this.$store.dispatch('auth/login', this.user)
            if (result) {
                this.$router.push('/')
            } else {
                this.login_failed = true
            }
        }
    },
    data() {
        return {
            user: {},
            login_failed: false,
        }
    },
}

</script>
