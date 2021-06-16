<template>
    <div>
        <nav class="navbar bg-white border-bottom navbar-light">
            <router-link class="navbar-brand mr-auto" v-bind:to="{ name: 'home' }">Laravel BnB</router-link>
        </nav>

        <div class="container mb-4 mt-4 pr-4 pl-4">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
    data() {
        return {
            lastSearch: this.$store.state.lastSearch
        };
    },

    computed: {
        ...mapState({
            lastSearchComputed: "lastSearch"
        }),
    }
}
</script>
