<template>

<div class="row">
    <div v-for="category in giftCategories" :key="category.id" class="col-12 col-sm-6 col-md-4">
        <div class="card">
            <router-link :to="{ name:'Items', params:{ gift_category_id:category.id,}}">
                <header class="card-header text-dark">
                    <i class="fs-18 pr-1" v-bind:class="category.icon"></i>
                    <strong>{{ category.title1 }}</strong>
                    <div class="card-header-actions">
                        <small class="text-muted"> {{ category.title2 }}</small>
                    </div>
                </header>
                <div class="card-body">
                    <div class="carousel slide">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img :src="'/storage/img/gifts/categories/' + category.image" class="d-block img-fluid">
                                <div class="carousel-caption">
                                    <h3>{{ category.title }}</h3>
                                    <p>Earn points and win your favorite gifts.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </router-link>
        </div>
    </div>
</div>

</template>

<script>

export default {
    methods: {
        getGiftCategories: function() {
            const url = '/api/get/gift/categories'
            axios.get(url)
            .then( response => {
                console.log(response.data)
                this.giftCategories = response.data
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
        this.getGiftCategories()
    },
    data() {
        return {
            giftCategories: {},
        }
    },
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
    height: 250px;
    object-fit: cover;
    transition:1s all;
}

img:hover{
    transform:scale(1.2,1.2);
    transition:1s all;
}

</style>