import Vue from 'vue';
import Vuex from 'vuex';

import searchresults from './modules/searchresults.js';
import decklist from './modules/decklist.js';
import pagination from './modules/pagination.js';
import modals from './modules/modals.js';

Vue.use( Vuex );

export const store = new Vuex.Store( {
    modules : {
        searchresults,
        decklist,
        pagination,
        modals
    }
} );
