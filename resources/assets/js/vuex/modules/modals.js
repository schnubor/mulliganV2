import * as types from './../types.js';
import axios from 'axios';

const state = {
    cardModal : {
        visible : false,
        card    : {}
    },
    landModal : {
        visible : false
    },
    saveModal : {
        visible : false,
        loading : false,
        error   : false,
        formats : []
    },
    statsModal : {
        visible : false
    }
};

const getters = {
    cardModal( state ) {
        return state.cardModal;
    },
    landModal( state ) {
        return state.landModal;
    },
    saveModal( state ) {
        return state.saveModal;
    },
    statsModal( state ) {
        return state.statsModal;
    }
};

const mutations = {
    [types.SHOW_CARD_MODAL]( state, payload ) {
        state.cardModal.card = payload.card;
        state.cardModal.visible = true;
    },
    [types.HIDE_CARD_MODAL]( state ) {
        state.cardModal.card = {};
        state.cardModal.visible = false;
    },
    [types.SHOW_LAND_MODAL]( state ) {
        state.landModal.visible = true;
    },
    [types.HIDE_LAND_MODAL]( state ) {
        state.landModal.visible = false;
    },
    [types.SHOW_SAVE_MODAL]( state ) {
        state.saveModal.visible = true;
    },
    [types.HIDE_SAVE_MODAL]( state ) {
        state.saveModal.visible = false;
    },
    [types.BEGIN_FETCHING_FORMATS]( state ) {
        state.saveModal.loading = true;
        state.saveModal.error = false;
    },
    [types.FETCHED_FORMATS_SUCCESSFUL]( state, formats ) {
        state.saveModal.loading = false;
        state.saveModal.error = false;
        state.saveModal.formats = formats;
    },
    [types.FETCHED_FORMATS_UNSUCCESSFUL]( state ) {
        state.saveModal.loading = false;
        state.saveModal.error = true;
    },
    [types.SHOW_STATS_MODAL]( state ) {
        state.statsModal.visible = true;
    },
    [types.HIDE_STATS_MODAL]( state ) {
        state.statsModal.visible = false;
    }
};

const actions = {
    showCardModal( { commit }, card ) {
        commit( types.SHOW_CARD_MODAL, card );
    },
    hideCardModal( { commit } ) {
        commit( types.HIDE_CARD_MODAL );
    },
    showLandModal( { commit }, card ) {
        commit( types.SHOW_LAND_MODAL );
    },
    hideLandModal( { commit } ) {
        commit( types.HIDE_LAND_MODAL );
    },
    showSaveModal( { commit }, card ) {
        commit( types.SHOW_SAVE_MODAL );
    },
    hideSaveModal( { commit } ) {
        commit( types.HIDE_SAVE_MODAL );
    },
    fetchFormats( { commit } ) {
        commit( types.BEGIN_FETCHING_FORMATS );
        axios.get( 'https://api.magicthegathering.io/v1/formats', { timeout : 10000 } )
        .then( function( response ) {
            const formats = response.data.formats;
            commit( types.FETCHED_FORMATS_SUCCESSFUL, formats );
        } ).catch( ( error ) => {
            commit( types.SET_API_ERROR );
            console.warn( error );
        } );
    },
    showStatsModal( { commit }, card ) {
        commit( types.SHOW_STATS_MODAL );
    },
    hideStatsModal( { commit } ) {
        commit( types.HIDE_STATS_MODAL );
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};

