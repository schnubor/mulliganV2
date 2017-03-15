import Vue from 'vue';
import Quicksearch from './components/Quicksearch.vue';
import Filterpanel from './components/Filterpanel.vue';

const app = new Vue( {
    el : '#app',
    components : {
        Quicksearch,
        Filterpanel
    }
} );
