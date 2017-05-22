import Vue from 'vue';
import Quicksearch from './components/quicksearch/Quicksearch.vue';
import Deckbuilder from './components/deckbuilder/Deckbuilder.vue';
import Deck from './components/deck/Singledeck.vue';

import { store } from './vuex/store.js';

new Vue( {
    el         : '#app',
    store      : store,
    components : {
        Quicksearch,
        Deckbuilder,
        Deck
    }
} );
