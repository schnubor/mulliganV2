<template>
    <div>
        <Cardmodal :class="{ 'is-active' : showCardModal }" @closecardmodal="showCardModal = false"></Cardmodal>
        <Landmodal :class="{ 'is-active' : showLandModal }" @closelandmodal="showLandModal = false"></Landmodal>
        <Savemodal :class="{ 'is-active' : showSaveModal }" @closesavemodal="showSaveModal = false"></Savemodal>
        <Statsmodal :class="{ 'is-active' : showStatsModal }" @closestatsmodal="showStatsModal = false"></Statsmodal>

        <Filterpanel></Filterpanel>
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column is-3">
                        <Deckactions 
                                     @showsavemodal="showSaveModal = true" 
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
    import { EventBus } from './../../eventbus.js';

    export default {
        data() {
            return {
                showCardModal  : false,
                showLandModal  : false,
                showSaveModal  : false,
                showStatsModal : false
            };
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
        },
        created() {
            EventBus.$on( 'showcardmodal', this.showCardModalAction );
        },
        methods : {
            showCardModalAction( card ) {
                // TODO
                this.$store.state.cardModal = card;
                this.showCardModal = true;
            }
        }
    };
</script>
