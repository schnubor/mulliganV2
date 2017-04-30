<template>
    <div>
        <Cardmodal></Cardmodal>
        <Landmodal></Landmodal>
        <Savemodal></Savemodal>
        <Statsmodal></Statsmodal>

        <Filterpanel></Filterpanel>
        <section class="section" v-if="!apiError">
            <div class="container">
                <div class="columns">
                    <div class="column is-3">
                        <Deckactions>
                        </Deckactions>
                        <Decklist></Decklist>
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
