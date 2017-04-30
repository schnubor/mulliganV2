import * as types from './../types.js';
import _ from 'lodash';

const state = {
    decklist    : {
        cardsum         : 0,
        artifacts       : [],
        lands           : [],
        creatures       : [],
        sorceries       : [],
        instants        : [],
        planeswalker    : [],
        enchantments    : [],
        basiclands      : {
            'mountains' : 0,
            'plains'    : 0,
            'forests'   : 0,
            'islands'   : 0,
            'swamps'    : 0
        }
    }
};

const getters = {
    artifacts( state ) {
        return state.decklist.artifacts;
    },
    lands( state ) {
        return state.decklist.lands;
    },
    creatures( state ) {
        return state.decklist.creatures;
    },
    sorceries( state ) {
        return state.decklist.sorceries;
    },
    instants( state ) {
        return state.decklist.instants;
    },
    planeswalker( state ) {
        return state.decklist.planeswalker;
    },
    enchantments( state ) {
        return state.decklist.enchantments;
    },
    basiclands( state ) {
        return state.decklist.basiclands;
    },
    totalCards( state ) {
        let artifactSum = 0;
        let creatureSum = 0;
        let enchantmentSum = 0;
        let instantSum = 0;
        let sorcerySum = 0;
        let planeswalkerSum = 0;
        let landSum = 0;
        let basicLandSum = 0;
        let cardSum = 0;

        for ( const artifact of state.decklist.artifacts ) {
            artifactSum += artifact.qty;
        }
        for ( const creature of state.decklist.creatures ) {
            creatureSum += creature.qty;
        }
        for ( const enchantment of state.decklist.enchantments ) {
            enchantmentSum += enchantment.qty;
        }
        for ( const instant of state.decklist.instants ) {
            instantSum += instant.qty;
        }
        for ( const sorcery of state.decklist.sorceries ) {
            sorcerySum += sorcery.qty;
        }
        for ( const planeswalker of state.decklist.planeswalker ) {
            planeswalkerSum += planeswalker.qty;
        }
        for ( const land of state.decklist.lands ) {
            landSum += land.qty;
        }

        basicLandSum = state.decklist.basiclands.mountains + state.decklist.basiclands.plains + state.decklist.basiclands.forests + state.decklist.basiclands.islands + state.decklist.basiclands.swamps;

        cardSum = artifactSum + creatureSum + enchantmentSum + instantSum + sorcerySum + planeswalkerSum + landSum + basicLandSum;

        return cardSum;
    }
};

const mutations = {
    [types.ADD_TO_DECKLIST]( state, payload ) {
        const card = payload.card;
        let list = null;

        switch ( card.types[ 0 ] ) {
            case 'Creature' :
                list = state.decklist.creatures;
                break;
            case 'Instant' :
                list = state.decklist.isntants;
                break;
            case 'Sorcery' :
                list = state.decklist.sorceries;
                break;
            case 'Land' :
                list = state.decklist.lands;
                break;
            case 'Artifact' :
                list = state.decklist.artifacts;
                break;
            case 'Enchantment' :
                list = state.decklist.enchantments;
                break;
            case 'Planeswalker' :
                list = state.decklist.planeswalker;
                break;
            default: break;
        }

        const existingCardIndex = _.findIndex( list, { 'id' : card.id } );

        if ( existingCardIndex > -1 ) {
            list[ existingCardIndex ].qty++;
        }
        else {
            const newCard = {
                'id'   : card.id,
                'card' : card,
                'qty'  : 1
            };
            list.push( newCard );
        }
    },
    [types.REMOVE_CARD_FROM_ENTRY]( state, payload ) {
        const list = payload.list;
        const id = payload.id;

        const index = _.findIndex( state.decklist[ list ], { id : id } );

        if ( state.decklist[ list ][ index ].qty > 1 ) {
            state.decklist[ list ][ index ].qty--;
        }
        else {
            state.decklist[ list ][ index ].qty--;
            _.remove( state.decklist[ list ], { id : id } );
        }
    },
    [types.REMOVE_ENTRY]( state, payload ) {
        const list = payload.list;
        const id = payload.id;

        const index = _.findIndex( state.decklist[ list ], { id : id } );

        state.decklist[ list ][ index ].qty = 0;
        _.remove( state.decklist[ list ], { id : id } );
    }
};

const actions = {
    addToDecklist( { commit }, card ) {
        commit( types.ADD_TO_DECKLIST, card );
    },
    removeCard( { commit }, payload ) {
        commit( types.REMOVE_CARD_FROM_ENTRY, payload );
    },
    removeEntry( { commit }, payload ) {
        commit( types.REMOVE_ENTRY, payload );
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
