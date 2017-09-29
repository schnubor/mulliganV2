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
        form : {
            title       : '',
            description : '',
            formats     : [],
            format      : '',
            tags        : [],
            wip         : true
        },
        visible     : false,
        loading     : false,
        error       : false,
        saving      : false,
        saved       : false,
        decklink    : ''
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
    },
    saveModalForm( state ) {
        return state.saveModal.form;
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
    },
    [types.BEGIN_DECK_SAVING]( state ) {
        state.saveModal.saving = true;
        state.saveModal.saved = false;
        state.saveModal.error = false;
    },
    [types.DECK_SAVING_SUCCESSFUL]( state, link ) {
        state.saveModal.saved = true;
        state.saveModal.saving = false;
        state.saveModal.error = false;
        state.saveModal.decklink = link;
    },
    [types.DECK_SAVING_FAILED]( state ) {
        state.saveModal.saved = false;
        state.saveModal.saving = false;
        state.saveModal.error = true;
    },
    [types.UPDATE_SAVE_MODAL]( state, formData ) {
        console.log( 'formData', formData );
        state.saveModal.form = formData;
    },
    [types.UPDATE_SAVE_MODAL_TITLE]( state, payload ) {
        state.saveModal.form.title = payload.title;
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
    showStatsModal( { commit } ) {
        commit( types.SHOW_STATS_MODAL );
    },
    hideStatsModal( { commit } ) {
        commit( types.HIDE_STATS_MODAL );
    },
    saveDeck( { commit }, payload ) {
        commit( types.BEGIN_DECK_SAVING );
        axios.post( '/api/decks', payload.data )
        .then( function( response ) {
            const link = window.location.protocol + '//' + window.location.host + '/decks/' + response.data.deckname;
            commit( types.DECK_SAVING_SUCCESSFUL, link );
        } )
        .catch( function( error ) {
            commit( types.DECK_SAVING_FAILED );
            console.warn( error );
        } );
    },
    updateFormData( { commit }, payload ) {
        commit( types.UPDATE_SAVE_MODAL, payload );
    },
    updateSaveModalTitle( { commit }, payload ) {
        commit( types.UPDATE_SAVE_MODAL_TITLE, payload );
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};

