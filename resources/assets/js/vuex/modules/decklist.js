import * as types from './../types.js';
import _ from 'lodash';

const state = {
    deckcolors  : [],
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
    deckcolors( state ) {
        return _.uniq( state.deckcolors );
    },
    decklist( state ) {
        return state.decklist;
    },
    artifacts( state ) {
        return state.decklist.artifacts;
    },
    artifactCount( state ) {
        let count = 0;
        state.decklist.artifacts.forEach( ( artifact ) => {
            count += artifact.qty;
        } );
        return count;
    },
    lands( state ) {
        return state.decklist.lands;
    },
    landCount( state ) {
        let count = 0;
        state.decklist.lands.forEach( ( land ) => {
            count += land.qty;
        } );
        return count;
    },
    creatures( state ) {
        return state.decklist.creatures;
    },
    creatureCount( state ) {
        let count = 0;
        state.decklist.creatures.forEach( ( creature ) => {
            count += creature.qty;
        } );
        return count;
    },
    sorceries( state ) {
        return state.decklist.sorceries;
    },
    sorceryCount( state ) {
        let count = 0;
        state.decklist.sorceries.forEach( ( sorcery ) => {
            count += sorcery.qty;
        } );
        return count;
    },
    instants( state ) {
        return state.decklist.instants;
    },
    instantCount( state ) {
        let count = 0;
        state.decklist.instants.forEach( ( instant ) => {
            count += instant.qty;
        } );
        return count;
    },
    planeswalker( state ) {
        return state.decklist.planeswalker;
    },
    planeswalkerCount( state ) {
        let count = 0;
        state.decklist.planeswalker.forEach( ( planeswalker ) => {
            count += planeswalker.qty;
        } );
        return count;
    },
    enchantments( state ) {
        return state.decklist.enchantments;
    },
    enchantmentCount( state ) {
        let count = 0;
        state.decklist.enchantments.forEach( ( enchantment ) => {
            count += enchantment.qty;
        } );
        return count;
    },
    basiclands( state ) {
        return state.decklist.basiclands;
    },
    basiclandCount( state ) {
        let count = 0;
        count += state.decklist.basiclands.mountains;
        count += state.decklist.basiclands.plains;
        count += state.decklist.basiclands.islands;
        count += state.decklist.basiclands.forests;
        count += state.decklist.basiclands.swamps;
        return count;
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
                list = state.decklist.instants;
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

        // update Deck colors
        if ( card.colorIdentity ) {
            state.deckcolors = state.deckcolors.concat( card.colorIdentity );
        }
    },
    [types.REMOVE_CARD_FROM_ENTRY]( state, payload ) {
        const list = payload.list;
        const id = payload.id;

        const index = _.findIndex( state.decklist[ list ], { id : id } );
        const entry = state.decklist[ list ][ index ];

        if ( entry.qty > 1 ) {
            entry.qty--;
        }
        else {
            entry.qty--;
            _.remove( state.decklist[ list ], { id : id } );
        }

        // update Deck colors
        if ( entry.card.colorIdentity ) {
            entry.card.colorIdentity.forEach( ( value, index ) => {
                const colorIndex = state.deckcolors.indexOf( value );
                if ( colorIndex > -1 ) {
                    state.deckcolors.splice( colorIndex, 1 );
                }
            } );
        }
    },
    [types.REMOVE_ENTRY]( state, payload ) {
        const list = payload.list;
        const id = payload.id;

        const index = _.findIndex( state.decklist[ list ], { id : id } );
        const entry = state.decklist[ list ][ index ];

        entry.qty = 0;
        _.remove( state.decklist[ list ], { id : id } );

        // update Deck colors
        if ( entry.card.colorIdentity ) {
            entry.card.colorIdentity.forEach( ( value, index ) => {
                const colorIndex = state.deckcolors.indexOf( value );
                if ( colorIndex > -1 ) {
                    state.deckcolors.splice( colorIndex, 1 );
                }
            } );
        }
    },
    [types.UPDATE_BASIC_LANDS]( state, payload ) {
        state.decklist.basiclands.mountains = payload.mountains;
        state.decklist.basiclands.plains = payload.plains;
        state.decklist.basiclands.forests = payload.forests;
        state.decklist.basiclands.islands = payload.islands;
        state.decklist.basiclands.swamps = payload.swamps;
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
    },
    updateBasicLands( { commit }, payload ) {
        commit( types.UPDATE_BASIC_LANDS, payload );
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
