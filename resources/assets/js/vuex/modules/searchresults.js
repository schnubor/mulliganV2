import * as types from './../types.js';

const state = {
    cardlist    : [],
    error       : 'Please search for cards or set filters above.',
    apiError    : false,
    maxResults  : 360,
    searching   : false
};

const getters = {
    cardlist( state ) {
        return state.cardlist;
    },
    searching( state ) {
        return state.searching;
    },
    maxResults( state ) {
        return state.maxResults;
    },
    totalResults( state ) {
        return state.cardlist.length;
    },
    searchError( state ) {
        return state.error;
    },
    apiError( state ) {
        return state.apiError;
    },
    isValidError( state ) {
        return state.error.length && ( !state.cardlist.length || state.cardlist.length > state.maxResults );
    }
};

const mutations = {
    [types.SET_API_ERROR]( state, payload ) {
        state.apiError = payload.error;
    },
    [types.SET_ERROR]( state, payload ) {
        state.error = payload.error;
    },
    [types.ADD_RESULT]( state, payload ) {
        state.cardlist.push( payload.card );
    },
    [types.START_SEARCH]( state ) {
        state.searching = true;
        state.cardlist = [];
        state.error = '';
    },
    [types.FINISH_SEARCH]( state ) {
        state.searching = false;
    }
};

const actions = {
    setAPIError( { commit }, error ) {
        commit( types.SET_API_ERROR, error );
    },
    setError( { commit }, error ) {
        commit( types.SET_ERROR, error );
    },
    addResult( { commit }, card ) {
        commit( types.ADD_RESULT, card );
    },
    startSearch( { commit } ) {
        commit( types.START_SEARCH );
    },
    finishSearch( { commit } ) {
        commit( types.FINISH_SEARCH );
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
