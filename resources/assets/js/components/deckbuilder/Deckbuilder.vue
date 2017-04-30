<template>
    <div>
        <Cardmodal></Cardmodal>
        <Landmodal></Landmodal>
        <Savemodal :class="{ 'is-active' : showSaveModal }" @closesavemodal="showSaveModal = false"></Savemodal>
        <Statsmodal :class="{ 'is-active' : showStatsModal }" @closestatsmodal="showStatsModal = false"></Statsmodal>

        <Filterpanel></Filterpanel>
        <section class="section" v-if="!apiError">
            <div class="container">
                <div class="columns">
                    <div class="column is-3">
                        <Deckactions @showsavemodal="showSaveModal = true" 
                                     @showstatsmodal="showStatsModal = true">
                        </Deckactions>
                        <Decklist @showlandmodal="showLandModal = true"></Decklist>
                    </div>
                    <Cardresults @showcardmodal="showCardModal = true"></Cardresults>
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
        data() {
            return {
                showSaveModal  : false,
                showStatsModal : false
            };
        },
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
