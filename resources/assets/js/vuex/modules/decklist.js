import * as types from './../types.js';
import _ from 'lodash';
import axios from 'axios';

const state = {
    fetching    : false,
    deckcolors  : [],
    activeList  : 'main',
    decklist    : {
        cardsum         : 0,
        artifacts       : {
            main      : [],
            sideboard : []
        },
        lands           : {
            main      : [],
            sideboard : []
        },
        creatures       : {
            main      : [],
            sideboard : []
        },
        sorceries       : {
            main      : [],
            sideboard : []
        },
        instants        : {
            main      : [],
            sideboard : []
        },
        planeswalker    : {
            main      : [],
            sideboard : []
        },
        enchantments    : {
            main      : [],
            sideboard : []
        },
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
    }
};

const getters = {
    fetching( state ) {
        return state.fetching;
    },
    deckcolors( state ) {
        return _.uniq( state.deckcolors );
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
        state.decklist.artifacts.main.forEach( ( artifact ) => {
            count += artifact.qty;
        } );
        return count;
    },
    lands( state ) {
        return state.decklist.lands;
    },
    landCount( state ) {
        let count = 0;
        state.decklist.lands.main.forEach( ( land ) => {
            count += land.qty;
        } );
        return count;
    },
    creatures( state ) {
        return state.decklist.creatures;
    },
    creatureCount( state ) {
        let count = 0;
        state.decklist.creatures.main.forEach( ( creature ) => {
            count += creature.qty;
        } );
        return count;
    },
    sorceries( state ) {
        return state.decklist.sorceries;
    },
    sorceryCount( state ) {
        let count = 0;
        state.decklist.sorceries.main.forEach( ( sorcery ) => {
            count += sorcery.qty;
        } );
        return count;
    },
    instants( state ) {
        return state.decklist.instants;
    },
    instantCount( state ) {
        let count = 0;
        state.decklist.instants.main.forEach( ( instant ) => {
            count += instant.qty;
        } );
        return count;
    },
    planeswalker( state ) {
        return state.decklist.planeswalker;
    },
    planeswalkerCount( state ) {
        let count = 0;
        state.decklist.planeswalker.main.forEach( ( planeswalker ) => {
            count += planeswalker.qty;
        } );
        return count;
    },
    enchantments( state ) {
        return state.decklist.enchantments;
    },
    enchantmentCount( state ) {
        let count = 0;
        state.decklist.enchantments.main.forEach( ( enchantment ) => {
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

        // ARTIFACTS
        for ( const artifact of state.decklist.artifacts.main ) {
            cardSum += artifact.qty;
        }
        for ( const artifact of state.decklist.artifacts.sideboard ) {
            sideboardSum += artifact.qty;
        }

        // CREATURES
        for ( const creature of state.decklist.creatures.main ) {
            cardSum += creature.qty;
        }
        for ( const creature of state.decklist.creatures.sideboard ) {
            sideboardSum += creature.qty;
        }

        // ENCHANTMENTS
        for ( const enchantment of state.decklist.enchantments.main ) {
            cardSum += enchantment.qty;
        }
        for ( const enchantment of state.decklist.enchantments.sideboard ) {
            sideboardSum += enchantment.qty;
        }

        // INSTANTS
        for ( const instant of state.decklist.instants.main ) {
            cardSum += instant.qty;
        }
        for ( const instant of state.decklist.instants.sideboard ) {
            sideboardSum += instant.qty;
        }

        // SORCERIES
        for ( const sorcery of state.decklist.sorceries.main ) {
            cardSum += sorcery.qty;
        }
        for ( const sorcery of state.decklist.sorceries.sideboard ) {
            sideboardSum += sorcery.qty;
        }

        // PLANESWALKER
        for ( const planeswalker of state.decklist.planeswalker.main ) {
            cardSum += planeswalker.qty;
        }
        for ( const planeswalker of state.decklist.planeswalker.sideboard ) {
            sideboardSum += planeswalker.qty;
        }

        // LANDS
        for ( const land of state.decklist.lands.main ) {
            cardSum += land.qty;
        }
        for ( const land of state.decklist.lands.sideboard ) {
            sideboardSum += land.qty;
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
        console.log( state.activeList );

        let list = null;

        switch ( card.types[ 0 ] ) {
            case 'Creature' :
                list = state.decklist.creatures[ state.activeList ];
                break;
            case 'Instant' :
                list = state.decklist.instants[ state.activeList ];
                break;
            case 'Sorcery' :
                list = state.decklist.sorceries[ state.activeList ];
                break;
            case 'Land' :
                list = state.decklist.lands[ state.activeList ];
                break;
            case 'Artifact' :
                list = state.decklist.artifacts[ state.activeList ];
                break;
            case 'Enchantment' :
                list = state.decklist.enchantments[ state.activeList ];
                break;
            case 'Planeswalker' :
                list = state.decklist.planeswalker[ state.activeList ];
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
    },
    [types.BEGIN_DECK_FETCHING]( state ) {
        state.fetching = true;
        state.error = false;
    },
    [types.DECK_FETCHING_SUCCESSFUL]( state, deck ) {
        state.fetching = false;
        state.error = false;
        state.decklist = JSON.parse( deck.decklist );
    },
    [types.DECK_FETCHING_FAILED]( state ) {
        state.fetching = false;
        state.error = true;
    }
};

const actions = {
    fetchDeckById( { commit }, payload ) {
        commit( types.BEGIN_DECK_FETCHING );
        axios.get( `/api/decks/${payload.id}`, { timeout : 10000 } )
        .then( function( response ) {
            const deck = response.data;

            // Fill Save Modal Form
            const saveModalFormData = {};
            saveModalFormData.title = deck.title;
            saveModalFormData.description = deck.description;
            saveModalFormData.format = deck.format;
            saveModalFormData.wip = deck.wip === 1;
            saveModalFormData.tags = JSON.parse( deck.tags );

            commit( types.UPDATE_SAVE_MODAL, saveModalFormData );

            commit( types.DECK_FETCHING_SUCCESSFUL, deck );
        } ).catch( ( error ) => {
            commit( types.DECK_FETCHING_FAILED );
            console.warn( error );
        } );
    },
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
