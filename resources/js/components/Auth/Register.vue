<template>
<div class="c-wrapper c-fixed-components">
<div class="c-body">
<main class="c-main">
<div class="container fade-in">

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card mx-4">
            <form v-on:submit.prevent="register">
                <div class="card-body p-4">
                    <h1>Register</h1>
                    <div class="row">
                        <div class="col-6">
                            <p class="text-muted">Create your account</p>
                        </div>
                        <div class="col-6 text-center">
                            <router-link to="/login" class="h5 font-weight-bold">Sign In</router-link>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <svg class="c-icon">
                                    <use xlink:href="assets/coreui.icon.svg#cil-user"></use>
                                </svg>
                            </span>
                        </div>
                        <input class="form-control" type="text" v-model="user.name" placeholder="Username">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <svg class="c-icon">
                                    <use xlink:href="assets/coreui.icon.svg#cil-credit-card"></use>
                                </svg>
                            </span>
                        </div>
                        <input class="form-control" type="text" v-model="user.login_id" placeholder="User ID">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <svg class="c-icon">
                                    <use xlink:href="assets/coreui.icon.svg#cil-envelope-open"></use>
                                </svg>
                            </span>
                        </div>
                        <input class="form-control" type="text" v-model="user.email" placeholder="Email">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <svg class="c-icon">
                                    <use xlink:href="assets/coreui.icon.svg#cil-lock-locked"></use>
                                </svg>
                            </span>
                        </div>
                        <input class="form-control" type="password" v-model="user.password" placeholder="Password">
                    </div>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <svg class="c-icon">
                                    <use xlink:href="assets/coreui.icon.svg#cil-lock-locked"></use>
                                </svg>
                            </span>
                        </div>
                        <input class="form-control" type="password" v-model="user.password_confirmation" placeholder="Repeat password">
                    </div>
                    <button class="btn btn-block btn-success" type="submit">Create Account</button>
                    <div v-if="register_failed" class="text-danger font-weight-bold p-1">
                        会員登録に失敗しました。
                    </div>
                </div>
            </form>
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
            user: {},
            register_failed: false
        }
    },
}
</script>