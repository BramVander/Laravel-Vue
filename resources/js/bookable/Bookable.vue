<template>
    <div class="row">
        <div class="col-md-8 pb-4" v-if="bookable">
            <div class="card">
                <div class="card-body">
                    <div v-if="loading">Loading...</div>
                    <div v-else>
                        <h2>{{ this.bookable.title }}</h2>
                        <hr />
                        <article>{{ this.bookable.description }}</article>
                    </div>
                </div>
            </div>
            <review-list :bookable-id="this.$route.params.id"></review-list>
        </div>
        <div class="col-md-4 pb-4">
            <availability :bookable-id="this.$route.params.id"></availability>
        </div>
    </div>
</template>

<script>
import Availability from "./availability";
import ReviewList from "./ReviewList";

export default ({
    components: {
        Availability,
        ReviewList
    },

    data() {
        return {
            bookable: null,
            loading: false
        };
    },
    
    created() {
        this.loading = true;
        axios.get(`/api/bookables/${this.$route.params.id}`)
            .then(response => this.bookable = response.data.data);
        this.loading = false;
    }
});
</script>