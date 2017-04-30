import * as types from './../types.js';

const state = {
    currentPage : 1,
    pageSize    : 12,
    totalPages  : null
};

const getters = {
    pageSize( state ) {
        return state.pageSize;
    },
    totalPages( state ) {
        return state.totalPages;
    },
    currentPage( state ) {
        return state.currentPage;
    }
};

const mutations = {
    [types.SET_TOTAL_PAGES]( state, payload ) {
        state.totalPages = payload.total;
    },
    [types.SET_NEXT_PAGE]( state ) {
        state.currentPage++;
    },
    [types.SET_PREV_PAGE]( state ) {
        state.currentPage--;
    },
    [types.START_SEARCH]( state ) {
        state.currentPage = 1;
    }
};

const actions = {
    setTotalPages( { commit }, total ) {
        commit( types.SET_TOTAL_PAGES, total );
    },
    setNextPage( { commit } ) {
        commit( types.SET_NEXT_PAGE );
    },
    setPrevPage( { commit } ) {
        commit( types.SET_PREV_PAGE );
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
