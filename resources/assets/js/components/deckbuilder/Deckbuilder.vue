<template>
    <div>
        <Filterpanel></Filterpanel>
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column is-3">
                        <Deckactions></Deckactions>
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

    export default {
        components : {
            Filterpanel,
            Cardresults,
            Decklist,
            Deckactions
        }
    };
</script>
