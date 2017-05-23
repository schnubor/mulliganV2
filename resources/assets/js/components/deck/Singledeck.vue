<template>
    <div>
        <section class="hero is-light">
            <div class="hero-body">
                <div class="container">
                    <div class="has-text-centered" v-if="loading">
                        <Spinner></Spinner>
                    </div>
                    <template v-if="!loading">
                        <Deckinfo :colors="colors" :tags="tags" :likes="likes"></Deckinfo>
                    </template>
                </div>
            </div>
        </section>
        <Tabs v-if="!loading"></Tabs>
    </div>
</template>

<script>
import Spinner from './../utils/Spinner.vue';
import Deckinfo from './Deckinfo.vue';
import Tabs from './Tabs.vue';

export default {
    props       : [ 'id' ],
    components  : {
        Spinner,
        Deckinfo,
        Tabs
    },
    computed : {
        loading() {
            return this.$store.getters.deckLoading;
        },
        colors() {
            return this.$store.getters.deckDeckcolors;
        },
        tags() {
            return this.$store.getters.deckTags;
        },
        likes() {
            return this.$store.getters.deckLikes;
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

<style lang="scss">
    .manaicon {
        margin: 0 4px;
    }
</style>

