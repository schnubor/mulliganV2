import * as types from './../types.js';

const state = {
    cardModal : {
        visible : false,
        card    : {}
    },
    landModal : {
        visible : false
    },
    saveModal : {
        visible : false
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
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};

