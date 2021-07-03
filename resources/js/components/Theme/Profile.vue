<template>

<div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-lg-8">
        <div class="card">
            <header class="card-header">
                <strong class="px-2"> Your Profile </strong>
                <small>Please set a profile</small>
            </header>
            <ValidationObserver ref="observer" v-slot="{ invalid }">
            <form v-on:submit.prevent="updateProfile">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="mt-3 mx-3">
                                <label for="user-image" class="user-image">
                                    <img v-show="preview" :src="preview" class="d-block img-fluid">
                                    <input v-on:change="changeUserImage" type="file" id="user-image">
                                </label>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">

                            <ValidationProvider name="名前" rules="required|max:100" v-slot="{ errors }">
                                <div class="form-group mb-1">
                                    <label>
                                        <svg class="c-icon mb-1">
                                            <use xlink:href="/assets/coreui.icon.svg#cil-user"></use>
                                        </svg>
                                        <span>Name</span>
                                    </label>
                                    <input v-model="user_name" type="text" placeholder="Enter your name" class="form-control">
                                </div>
                                <div class="text-danger p-1 mb-2">{{ errors[0] }}</div>
                            </ValidationProvider>

                            <ValidationProvider name="メールアドレス" rules="required|email|max:100" v-slot="{ errors }">
                                <div class="form-group mb-1">
                                    <label>
                                        <svg class="c-icon mb-1">
                                                <use xlink:href="/assets/coreui.icon.svg#cil-envelope-closed"></use>
                                        </svg>
                                        <span>Email</span>
                                    </label>
                                    <input v-model="user_email" type="text" placeholder="Enter your email" class="form-control">
                                </div>
                                <div class="text-danger p-1 mb-2">{{ errors[0] }}</div>
                            </ValidationProvider>

                            <div class="form-group">
                                <label for="" class="">
                                    <svg class="c-icon mb-1">
                                            <use xlink:href="/assets/coreui.icon.svg#cil-birthday-cake"></use>
                                    </svg>
                                    <span>Birthday</span>
                                </label>
                                <div class="form-inline d-flex justify-content-between">
                                    <select v-model="user_birth_year" class="form-control w-32">
                                        <option v-for="n in 32" :key="n" :value="1990 + n">
                                            {{ 1990 + n }}年
                                        </option>
                                    </select>
                                    <select v-model="user_birth_month" class="form-control w-32">
                                        <option v-for="n in 12" :key="n" :value="0 + n">
                                            {{ 0 + n }}月
                                        </option>
                                    </select>
                                    <select v-model="user_birth_day" class="form-control w-32">
                                        <option v-for="n in 31" :key="n" :value="0 + n">
                                            {{ 0 + n }}日
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <ValidationProvider name="お住まい" rules="max:200" v-slot="{ errors }">
                                <div class="form-group mb-1">
                                    <label>
                                        <svg class="c-icon mb-1">
                                                <use xlink:href="/assets/coreui.icon.svg#cil-location-pin"></use>
                                        </svg>
                                        <span>Location</span>
                                    </label>
                                    <input v-model="user_location" type="text" placeholder="Enter your location" class="form-control">
                                </div>
                                <div class="text-danger p-1 mb-2">{{ errors[0] }}</div>
                            </ValidationProvider>

                        </div>
                    </div>
                </div>
                <footer class="card-footer">
                    <div class="d-flex justify-content-center justify-content-sm-end">
                        <button type="submit" class="btn btn-primary font-weight-bold px-3 mx-2" :disabled="invalid">Save</button>
                    </div>
                </footer>
            </form>
            </ValidationObserver>
        </div>
    </div>
</div>

</template>

<script>

export default {
    methods: {
        findUser: async function() {
            const url = '/api/find/user'
            await axios.get(url)
            .then (response => {
                let userInfo = response.data
                this.user_name = userInfo.name,
                this.user_email = userInfo.email,
                this.user_birth_year = userInfo.birth_year,
                this.user_birth_month = userInfo.birth_month,
                this.user_birth_day = userInfo.birth_day,
                this.user_location = userInfo.location,
                this.user_image = userInfo.image,
                this.preview = userInfo.image
            }).catch ( error => {
                if (error.response.status === 401) {
                    this.$router.push({name:'Login'})
                } else {
                    console.log(error)
                }
            })
        },
        changeUserImage: function(e) {
            let file = e.target.files[0];
            if(file && file.type.match(/^image\/(png|jpeg)$/)){
                this.preview = URL.createObjectURL(file);
            }
            this.user_image = file
        },
        updateProfile: async function() {
            let formData = new FormData();
            formData.append('name', this.user_name);
            formData.append('email', this.user_email);
            formData.append('birth_year', this.user_birth_year);
            formData.append('birth_month', this.user_birth_month);
            formData.append('birth_day', this.user_birth_day);
            formData.append('location', this.user_location);
            formData.append('image', this.user_image);
            let config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            };
            const url = '/api/update/profile'
            await axios.post(url, formData, config)
            .then (response => {
                alert('プロフィールの更新が完了しました。')
            }).catch ( error => {
                let httpStatusCode = error.response.status
                if (httpStatusCode === 401) {
                    this.$router.push({name:'Login'})
                } else {
                    alert(error.response.data.message)
                    console.log(error)
                }
            })
        },
    },
    mounted() {
        this.findUser()
    },
    data() {
        return {
            user_name: '',
            user_email: '',
            user_birth_year: '',
            user_birth_month: '',
            user_birth_day: '',
            user_location: '',
            user_image: '',
            preview: '',
        }
    }
}

</script>



<style scoped>

img {
    width: 300px;
    height: 300px;
    object-fit: cover;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 50%;
}

.user-image {
    width: 300px;
    height: 300px;
    border-radius: 50%;
    cursor: pointer;
    transition:1s all;
}

.user-image:hover {
    transform:scale(1.05,1.05);
    transition:1s all;
}

input[type="file"] {
    display: none;
}

.w-32 {
    width: 32%;
}

</style>