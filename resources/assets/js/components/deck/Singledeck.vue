<template>
    <section class="hero is-light">
        <div class="hero-body">
            <div class="container">
                <div class="has-text-centered" v-if="loading">
                    <Spinner></Spinner>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import Spinner from './../utils/Spinner.vue';

export default {
    props       : [ 'id' ],
    components  : {
        Spinner
    },
    computed : {
        loading() {
            return this.$store.getters.deckLoading;
        }
    },
    mounted() {
        this.$store.dispatch( {
            type    : 'fetchDeck',
            id      : this.id
        } );
    }
};
</script>
