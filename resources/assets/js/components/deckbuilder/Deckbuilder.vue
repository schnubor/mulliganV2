<template>
    <div>
        <Cardmodal></Cardmodal>
        <Landmodal></Landmodal>
        <Savemodal :user="user"></Savemodal>
        <Statsmodal></Statsmodal>

        <Filterpanel></Filterpanel>
        <section class="section" v-if="!apiError">
            <div class="container">
                <div class="columns">
                    <div class="column is-3">
                        <Deckactions>
                        </Deckactions>
                        <Decklist :deckid="deckid"></Decklist>
                    </div>
                    <Cardresults></Cardresults>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import Filterpanel from './Filterpanel.vue';
    import Cardresults from './Cardresults.vue';
    import Decklist from './Decklist.vue';
    import Deckactions from './Deckactions.vue';
    import Cardmodal from './Cardmodal.vue';
    import Landmodal from './Landmodal.vue';
    import Savemodal from './Savemodal.vue';
    import Statsmodal from './Statsmodal.vue';

    export default {
        props: [ 'deckid', 'user' ],
        computed : {
            apiError() {
                return this.$store.getters.apiError;
            }
        },
        components : {
            Filterpanel,
            Cardresults,
            Decklist,
            Deckactions,
            Cardmodal,
            Landmodal,
            Savemodal,
            Statsmodal
        }
    };
</script>
