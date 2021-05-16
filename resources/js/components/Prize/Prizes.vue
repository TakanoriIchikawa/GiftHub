<template>
    <div class="row">
        <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
            <div class="card">
                <header class="card-header">
                    <strong> {{ $route.params.prize_category_name }} </strong><small>with badges</small>
                </header><div class="card-body">
                    <ul role="list-items" class="list-group">
                        <li v-for="prize in prizes" :key="prize.id" class="list-group-item d-flex justify-content-between align-items-center">{{ prize.name }}<span class="badge badge-primary badge-pill">{{ prize.points }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    methods: {
        getPrizes: function() {
            const prizeCategoryId = this.$route.params.prize_category_id
            const url = '/api/get/prizes/?prize_category_id=' + prizeCategoryId
            axios.get(url)
            .then ( response => {
                this.prizes = response.data
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
        this.getPrizes()
    },
    data() {
        return {
            prizes: {},
        }
    }
}

</script>