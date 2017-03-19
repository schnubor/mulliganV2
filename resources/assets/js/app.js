import Vue from 'vue';
import Quicksearch from './components/quicksearch/Quicksearch.vue';
import Filterpanel from './components/deckbuilder/Filterpanel.vue';
import Deckactions from './components/deckbuilder/Deckactions.vue';
import Decklist from './components/deckbuilder/Decklist.vue';
import Cardresults from './components/deckbuilder/Cardresults.vue';

new Vue( {
    el         : '#app',
    components : {
        Quicksearch,
        Filterpanel,
        Decklist,
        Cardresults,
        Deckactions
    }
} );
