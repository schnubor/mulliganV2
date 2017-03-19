import Vue from 'vue';
import Quicksearch from './components/quicksearch/Quicksearch.vue';
import Deckbuilder from './components/deckbuilder/Deckbuilder.vue';

new Vue( {
    el         : '#app',
    components : {
        Quicksearch,
        Deckbuilder
    }
} );
