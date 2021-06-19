<template>

<div class="row">
    <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
        <div class="card">
            <header class="card-header">
                <strong>ギフトのカテゴリ名</strong><small>with badges</small>
            </header><div class="card-body">
                <ul role="list-items" class="list-group">
                    <li v-for="item in giftItems" :key="item.id" class="list-group-item d-flex justify-content-between align-items-center">{{ item.name }}<span class="badge badge-primary badge-pill">{{ item.point }}</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

</template>

<script>

export default {
    methods: {
        getGiftItems: function() {
            const giftCategoryId = this.$route.params.gift_category_id
            const url = '/api/get/gift/items'
            axios.get(url, {
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
    },
    mounted() {
        this.getGiftItems()
    },
    data() {
        return {
            giftItems: {},
        }
    }
}

</script>