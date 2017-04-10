<template>
    <div>
        <Landmodal :class="{ 'is-active' : showLandModal }" @closelandmodal="showLandModal = false"></Landmodal>
        <Savemodal :class="{ 'is-active' : showSaveModal }" @closesavemodal="showSaveModal = false"></Savemodal>
        <Statsmodal :class="{ 'is-active' : showStatsModal }" @closestatsmodal="showStatsModal = false"></Statsmodal>

        <Filterpanel></Filterpanel>
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column is-3">
                        <Deckactions :shared="shared" 
                                     @showsavemodal="showSaveModal = true" 
                                     @showstatsmodal="showStatsModal = true">
                        </Deckactions>
                        <Decklist :shared="shared" @showlandmodal="showLandModal = true"></Decklist>
                    </div>
                    <Cardresults :shared="shared"></Cardresults>
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
    import Landmodal from './Landmodal.vue';
    import Savemodal from './Savemodal.vue';
    import Statsmodal from './Statsmodal.vue';
    import Store from './store.js';

    export default {
        data() {
            return {
                shared         : Store,
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
            Landmodal,
            Savemodal,
            Statsmodal
        }
    };
</script>
