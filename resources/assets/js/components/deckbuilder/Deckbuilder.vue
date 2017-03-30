<template>
    <div>
        <Landmodal :class="{ 'is-active' : showLandModal }" @closelandmodal="showLandModal = false"></Landmodal>
        <Filterpanel></Filterpanel>
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column is-3">
                        <Deckactions :shared="shared"></Deckactions>
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
    import Store from './store.js';

    export default {
        data() {
            return {
                shared        : Store,
                showLandModal : false
            };
        },
        components : {
            Filterpanel,
            Cardresults,
            Decklist,
            Deckactions,
            Landmodal
        }
    };
</script>
