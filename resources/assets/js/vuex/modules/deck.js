import * as types from './../types.js';
import _ from 'lodash';
import axios from 'axios';

import { basiclandCards } from './../../utils.js';

const state = {
    fetchedDeck : {
        title       : '',
        description : '',
        wip         : true,
        colors      : [],
        tags        : [],
        format      : '',
        likes       : 0,
        views       : 0,
        decklist    : {
            cardsum         : 0,
            artifacts       : {
                main        : [],
                sideboard   : []
            },
            lands           : {
                main        : [],
                sideboard   : []
            },
            creatures       : {
                main        : [],
                sideboard   : []
            },
            sorceries       : {
                main        : [],
                sideboard   : []
            },
            instants        : {
                main        : [],
                sideboard   : []
            },
            planeswalker    : {
                main        : [],
                sideboard   : []
            },
            enchantments    : {
                main        : [],
                sideboard   : []
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
    },
    deckLoading : false,
    deckError   : false
};

const getters = {
    deckTitle( state ) {
        return state.fetchedDeck.title;
    },
    deckDescription( state ) {
        return state.fetchedDeck.description;
    },
    deckLikes( state ) {
        return state.fetchedDeck.likes;
    },
    deckViews( state ) {
        return state.fetchedDeck.views;
    },
    deckFormat( state ) {
        return state.fetchedDeck.format;
    },
    deckTags( state ) {
        return state.fetchedDeck.tags;
    },
    deckLoading( state ) {
        return state.deckLoading;
    },
    deckDeckcolors( state ) {
        return _.uniq( state.fetchedDeck.colors );
    },
    deckDecklist( state ) {
        return state.fetchedDeck.decklist;
    },
    deckStatus( status ) {
        return state.fetchedDeck.wip;
    },
    decktags( status ) {
        return state.fetchedDeck.tags;
    },
    deckArtifacts( state ) {
        return state.fetchedDeck.decklist.artifacts;
    },
    deckArtifactCount( state ) {
        let count = 0;
        state.fetchedDeck.decklist.artifacts.main.forEach( ( artifact ) => {
            count += artifact.qty;
        } );
        return count;
    },
    deckLands( state ) {
        return state.fetchedDeck.decklist.lands;
    },
    deckLandCount( state ) {
        let count = 0;
        state.fetchedDeck.decklist.lands.main.forEach( ( land ) => {
            count += land.qty;
        } );
        return count;
    },
    deckCreatures( state ) {
        return state.fetchedDeck.decklist.creatures;
    },
    deckCreatureCount( state ) {
        let count = 0;
        state.fetchedDeck.decklist.creatures.main.forEach( ( creature ) => {
            count += creature.qty;
        } );
        return count;
    },
    deckSorceries( state ) {
        return state.fetchedDeck.decklist.sorceries;
    },
    deckSorceryCount( state ) {
        let count = 0;
        state.fetchedDeck.decklist.sorceries.main.forEach( ( sorcery ) => {
            count += sorcery.qty;
        } );
        return count;
    },
    deckInstants( state ) {
        return state.fetchedDeck.decklist.instants;
    },
    deckInstantCount( state ) {
        let count = 0;
        state.fetchedDeck.decklist.instants.main.forEach( ( instant ) => {
            count += instant.qty;
        } );
        return count;
    },
    deckPlaneswalker( state ) {
        return state.fetchedDeck.decklist.planeswalker;
    },
    deckPlaneswalkerCount( state ) {
        let count = 0;
        state.fetchedDeck.decklist.planeswalker.main.forEach( ( planeswalker ) => {
            count += planeswalker.qty;
        } );
        return count;
    },
    deckEnchantments( state ) {
        return state.fetchedDeck.decklist.enchantments;
    },
    deckEnchantmentCount( state ) {
        let count = 0;
        state.fetchedDeck.decklist.enchantments.main.forEach( ( enchantment ) => {
            count += enchantment.qty;
        } );
        return count;
    },
    deckBasiclands( state ) {
        return state.fetchedDeck.decklist.basiclands;
    },
    deckBasiclandCount( state ) {
        let count = 0;
        count += state.fetchedDeck.decklist.basiclands.main.mountains;
        count += state.fetchedDeck.decklist.basiclands.main.plains;
        count += state.fetchedDeck.decklist.basiclands.main.islands;
        count += state.fetchedDeck.decklist.basiclands.main.forests;
        count += state.fetchedDeck.decklist.basiclands.main.swamps;
        return count;
    },
    deckStarthand( state ) {
        const allCards = [];

        const artifacts = getters.deckArtifacts( state );
        const creatures = getters.deckCreatures( state );
        const sorceries = getters.deckSorceries( state );
        const instants = getters.deckInstants( state );
        const planeswalker = getters.deckPlaneswalker( state );
        const enchantments = getters.deckEnchantments( state );
        const lands = getters.deckLands( state );
        const basiclands = getters.deckBasiclands( state );

        artifacts.main.forEach( ( artifact ) => {
            for ( let i = 0; i < artifact.qty; i++ ) {
                allCards.push( artifact );
            }
        } );

        creatures.main.forEach( ( creature ) => {
            for ( let i = 0; i < creature.qty; i++ ) {
                allCards.push( creature );
            }
        } );

        sorceries.main.forEach( ( sorcery ) => {
            for ( let i = 0; i < sorcery.qty; i++ ) {
                allCards.push( sorcery );
            }
        } );

        instants.main.forEach( ( instant ) => {
            for ( let i = 0; i < instant.qty; i++ ) {
                allCards.push( instant );
            }
        } );

        planeswalker.main.forEach( ( planeswalker ) => {
            for ( let i = 0; i < planeswalker.qty; i++ ) {
                allCards.push( planeswalker );
            }
        } );

        enchantments.main.forEach( ( enchantment ) => {
            for ( let i = 0; i < enchantment.qty; i++ ) {
                allCards.push( enchantment );
            }
        } );

        lands.main.forEach( ( land ) => {
            for ( let i = 0; i < land.qty; i++ ) {
                allCards.push( land );
            }
        } );

        // TODO: include basic lands in allCards
        for ( let i = 0; i < basiclands.main.mountains; i++ ) {
            allCards.push( basiclandCards.mountain );
        }

        for ( let i = 0; i < basiclands.main.plains; i++ ) {
            allCards.push( basiclandCards.plains );
        }

        for ( let i = 0; i < basiclands.main.swamps; i++ ) {
            allCards.push( basiclandCards.swamp );
        }

        for ( let i = 0; i < basiclands.main.islands; i++ ) {
            allCards.push( basiclandCards.island );
        }

        for ( let i = 0; i < basiclands.main.forests; i++ ) {
            allCards.push( basiclandCards.forest );
        }

        // shuffle cards
        allCards.sort( function() {
            return 0.5 - Math.random();
        } );

        const randomCards = allCards.slice( 0, 7 );

        console.log( randomCards );

        return randomCards;
    },
    deckTotalCards( state ) {
        let artifactSum = 0;
        let creatureSum = 0;
        let enchantmentSum = 0;
        let instantSum = 0;
        let sorcerySum = 0;
        let planeswalkerSum = 0;
        let landSum = 0;
        let basicLandSum = 0;
        let cardSum = 0;

        for ( const artifact of state.fetchedDeck.decklist.artifacts.main ) {
            artifactSum += artifact.qty;
        }
        for ( const creature of state.fetchedDeck.decklist.creatures.main ) {
            creatureSum += creature.qty;
        }
        for ( const enchantment of state.fetchedDeck.decklist.enchantments.main ) {
            enchantmentSum += enchantment.qty;
        }
        for ( const instant of state.fetchedDeck.decklist.instants.main ) {
            instantSum += instant.qty;
        }
        for ( const sorcery of state.fetchedDeck.decklist.sorceries.main ) {
            sorcerySum += sorcery.qty;
        }
        for ( const planeswalker of state.fetchedDeck.decklist.planeswalker.main ) {
            planeswalkerSum += planeswalker.qty;
        }
        for ( const land of state.fetchedDeck.decklist.lands.main ) {
            landSum += land.qty;
        }

        basicLandSum = state.fetchedDeck.decklist.basiclands.main.mountains + state.fetchedDeck.decklist.basiclands.main.plains + state.fetchedDeck.decklist.basiclands.main.forests + state.fetchedDeck.decklist.basiclands.main.islands + state.fetchedDeck.decklist.basiclands.main.swamps;

        cardSum = artifactSum + creatureSum + enchantmentSum + instantSum + sorcerySum + planeswalkerSum + landSum + basicLandSum;

        return cardSum;
    }
};

const mutations = {
    [types.BEGIN_FETCHING_DECK]( state ) {
        state.deckLoading = true;
        state.deckError = false;
    },
    [types.FETCHING_DECK_SUCCESSFUL]( state, payload ) {
        state.deckLoading = false;
        state.deckError = false;
        // assign deck to state
        state.fetchedDeck.title = payload.title;
        state.fetchedDeck.description = payload.description;
        state.fetchedDeck.format = payload.format;
        state.fetchedDeck.decklist = JSON.parse( payload.decklist );
        state.fetchedDeck.colors = JSON.parse( payload.colors );
        state.fetchedDeck.wip = JSON.parse( payload.wip );
        state.fetchedDeck.likes = payload.likes;
        state.fetchedDeck.views = payload.views;
        state.fetchedDeck.tags = JSON.parse( payload.tags );
    },
    [types.FETCHING_DECK_UNSUCCESSFUL]( state ) {
        state.deckLoading = false;
        state.deckError = true;
    }
};

const actions = {
    fetchDeck( { commit }, payload ) {
        commit( types.BEGIN_FETCHING_DECK );
        axios.get( `/api/decks/${payload.id}`, { timeout : 10000 } )
        .then( function( response ) {
            const deck = response.data;
            commit( types.FETCHING_DECK_SUCCESSFUL, deck );
        } ).catch( ( error ) => {
            commit( types.FETCHING_DECK_UNSUCCESSFUL );
            console.warn( error );
        } );
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
