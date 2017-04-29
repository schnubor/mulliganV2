import Vue from 'vue';
import Vuex from 'vuex';

import decklist from './modules/decklist.js';
import pagination from './modules/pagination.js';
import modals from './modules/modals.js';

Vue.use( Vuex );

export const store = new Vuex.Store( {
    modules : {
        decklist,
        pagination,
        modals
    }
} );
