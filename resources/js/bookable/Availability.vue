<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bolder">Check availability
            <span v-if="noAvailability" class="text-danger">Not available</span>
            <span v-if="hasAvailability" class="text-success">Available</span>
        </h6>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="from">From</label>
                <input 
                    type="text" 
                    name="from" 
                    class="form-control form-control-sm" 
                    v-model="from"
                    placeholder="Start date"
                    @keyup.enter="check"
                    :class="[{'is-invalid':  errorFor('from')}]"
                />
                <validation-errors :errors="errorFor('from')"></validation-errors>
            </div>

            <div class="form-group col-md-6">
                <label for="from">To</label>
                <input 
                    type="text" 
                    name="to" 
                    class="form-control form-control-sm" 
                    v-model="to"
                    placeholder="End date"
                    @keyup.enter="check"
                    :class="[{'is-invalid': errorFor('to')}]"
                />
                <validation-errors :errors="errorFor('to')"></validation-errors>
            </div>
        </div>
        <button class="btn btn-secondary btn-block" @click="check" :disabled="loading">Check</button>
    </div>
</template>

<script>
import {is422, } from './../shared/utils/response';
import validationErrors from './../shared/mixins/validationErrors';

export default ({
    mixins: [validationErrors],

    props: {
        bookableId: [String, Number]
    },

    data() {
        return {
            from: this.$store.state.lastSearch.from,
            to: this.$store.state.lastSearch.to,
            loading: false,
            status: null,
        };
    },

    methods: {
        check() {
            this.loading = true;
            this.errors = null;

            this.$store.commit('setLastSearch', {
                from: this.from,
                to: this.to
            });

            axios.get(
                `/api/bookables/${this.bookableId}/availability?from=${this.from}&to=${this.to}`
            ).then(response => {
                this.status = response.status;
            }).catch(error => {
                if(is422(error)) {
                    this.errors = error.response.data.errors;
                }

                this.status = error.response.status;
            }).then(() => (this.loading = false));
        }
    },

    computed: {
        hasErrors() {
            return 422 === this.status && this.errors !== null;
        },
        hasAvailability() {
            return 200 === this.status;
        },
        noAvailability() {
            return 404 === this.status;
        }
    }
});

</script>

<style scoped>
    label {
        font-size: 0.7rem;
        text-transform: uppercase;
        color: grey;
        font-weight: bolder;
    }
</style>