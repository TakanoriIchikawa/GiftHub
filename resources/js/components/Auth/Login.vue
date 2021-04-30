<template>
<div class="c-wrapper c-fixed-components">
<div class="c-body">
<main class="c-main">
<div class="container fade-in">

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-group">
            <div class="card p-4">
                <form v-on:submit.prevent="login">
                    <div class="card-body">
                        <h1>Login</h1>
                        <p class="text-muted">Sign In to your account</p>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="assets/coreui.icon.svg#cil-credit-card"></use>
                                    </svg>
                                </span>
                            </div>
                            <input class="form-control" v-model="user.login_id" type="text" placeholder="User ID">
                        </div>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg class="c-icon">
                                        <use xlink:href="assets/coreui.icon.svg#cil-lock-locked"></use>
                                    </svg>
                                </span>
                            </div>
                            <input class="form-control" v-model="user.password" type="password" placeholder="Password">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary px-4" type="submit">Login</button>
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
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
                <div class="card-body text-center">
                    <div>
                        <h2>Sign up</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <router-link to="/register">
                            <button class="btn btn-lg btn-outline-light mt-3" type="button">Register Now!</button>
                        </router-link>
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
