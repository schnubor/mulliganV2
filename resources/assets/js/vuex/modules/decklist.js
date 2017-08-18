import * as types from './../types.js';
import _ from 'lodash';

const state = {
    deckcolors  : [],
    activeList  : 'main',
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
            main : {
                'mountains' : 0,
                'plains'    : 0,
                'forests'   : 0,
                'islands'   : 0,
                'swamps'    : 0
            },
            sideboard : {
                'mountains' : 0,
                'plains'    : 0,
                'forests'   : 0,
                'islands'   : 0,
                'swamps'    : 0
            }
        }
    },
    sideboard   : []
};

const getters = {
    deckcolors( state ) {
        return _.uniq( state.deckcolors );
    },
    sideboard( state ) {
        return state.sideboard;
    },
    activeList( state ) {
        return state.activeList;
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
        let mainCount = 0;
        let sideboardCount = 0;

        mainCount += state.decklist.basiclands.main.mountains;
        mainCount += state.decklist.basiclands.main.plains;
        mainCount += state.decklist.basiclands.main.islands;
        mainCount += state.decklist.basiclands.main.forests;
        mainCount += state.decklist.basiclands.main.swamps;

        sideboardCount += state.decklist.basiclands.sideboard.mountains;
        sideboardCount += state.decklist.basiclands.sideboard.plains;
        sideboardCount += state.decklist.basiclands.sideboard.islands;
        sideboardCount += state.decklist.basiclands.sideboard.forests;
        sideboardCount += state.decklist.basiclands.sideboard.swamps;

        return {
            main      : mainCount,
            sideboard : sideboardCount
        };
    },
    totalCards( state ) {
        let mainBasicLandSum = 0;
        let sideboardBasicLandSum = 0;
        let cardSum = 0;
        let sideboardSum = 0;

        for ( const artifact of state.decklist.artifacts ) {
            if ( artifact.list === 'sideboard' ) {
                sideboardSum += artifact.qty;
            }
            else {
                cardSum += artifact.qty;
            }
        }
        for ( const creature of state.decklist.creatures ) {
            if ( creature.list === 'sideboard' ) {
                sideboardSum += creature.qty;
            }
            else {
                cardSum += creature.qty;
            }
        }
        for ( const enchantment of state.decklist.enchantments ) {
            if ( enchantment.list === 'sideboard' ) {
                sideboardSum += enchantment.qty;
            }
            else {
                cardSum += enchantment.qty;
            }
        }
        for ( const instant of state.decklist.instants ) {
            if ( instant.list === 'sideboard' ) {
                sideboardSum += instant.qty;
            }
            else {
                cardSum += instant.qty;
            }
        }
        for ( const sorcery of state.decklist.sorceries ) {
            if ( sorcery.list === 'sideboard' ) {
                sideboardSum += sorcery.qty;
            }
            else {
                cardSum += sorcery.qty;
            }
        }
        for ( const planeswalker of state.decklist.planeswalker ) {
            if ( planeswalker.list === 'sideboard' ) {
                sideboardSum += planeswalker.qty;
            }
            else {
                cardSum += planeswalker.qty;
            }
        }
        for ( const land of state.decklist.lands ) {
            if ( land.list === 'sideboard' ) {
                sideboardSum += land.qty;
            }
            else {
                cardSum += land.qty;
            }
        }

        mainBasicLandSum = state.decklist.basiclands.main.mountains + state.decklist.basiclands.main.plains + state.decklist.basiclands.main.forests + state.decklist.basiclands.main.islands + state.decklist.basiclands.main.swamps;
        sideboardBasicLandSum = state.decklist.basiclands.sideboard.mountains + state.decklist.basiclands.sideboard.plains + state.decklist.basiclands.sideboard.forests + state.decklist.basiclands.sideboard.islands + state.decklist.basiclands.sideboard.swamps;

        cardSum = cardSum + mainBasicLandSum;
        sideboardSum = sideboardSum + sideboardBasicLandSum;

        return {
            main      : cardSum,
            sideboard : sideboardSum
        };
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

        // Add to existing list or create new
        const existingCardIndex = _.findIndex( list, { 'id' : card.id } );

        if ( existingCardIndex > -1 ) {
            list[ existingCardIndex ].qty++;
        }
        else {
            const newCard = {
                'id'   : card.id,
                'card' : card,
                'qty'  : 1,
                'list' : state.activeList
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
        state.decklist.basiclands[payload.list].mountains = payload.mountains;
        state.decklist.basiclands[payload.list].plains = payload.plains;
        state.decklist.basiclands[payload.list].forests = payload.forests;
        state.decklist.basiclands[payload.list].islands = payload.islands;
        state.decklist.basiclands[payload.list].swamps = payload.swamps;
    },
    [types.SWITCH_ACTIVE_LIST]( state, payload ) {
        state.activeList = payload.list;
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
    },
    switchActiveList( { commit }, payload ) {
        commit( types.SWITCH_ACTIVE_LIST, payload );
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
