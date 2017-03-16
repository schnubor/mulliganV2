import Vue from 'vue';
import Quicksearch from './components/Quicksearch.vue';
import Filterpanel from './components/Filterpanel.vue';
import Decklist from './components/Decklist.vue';
import Cardresults from './components/Cardresults.vue';

const app = new Vue( {
    el : '#app',
    components : {
        Quicksearch,
        Filterpanel,
        Decklist,
        Cardresults
    }
} );
