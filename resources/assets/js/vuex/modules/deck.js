import * as types from './../types.js';
import _ from 'lodash';
import axios from 'axios';

const state = {
    fetchedDeck : {
        title       : '',
        description : '',
        wip         : true,
        colors      : [],
        tags        : [],
        format      : '',
        likes       : 0,
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
        state.fetchedDeck.decklist.artifacts.forEach( ( artifact ) => {
            count += artifact.qty;
        } );
        return count;
    },
    deckLands( state ) {
        return state.fetchedDeck.decklist.lands;
    },
    deckLandCount( state ) {
        let count = 0;
        state.fetchedDeck.decklist.lands.forEach( ( land ) => {
            count += land.qty;
        } );
        return count;
    },
    deckCreatures( state ) {
        return state.fetchedDeck.decklist.creatures;
    },
    deckCreatureCount( state ) {
        let count = 0;
        state.fetchedDeck.decklist.creatures.forEach( ( creature ) => {
            count += creature.qty;
        } );
        return count;
    },
    deckSorceries( state ) {
        return state.fetchedDeck.decklist.sorceries;
    },
    deckSorceryCount( state ) {
        let count = 0;
        state.fetchedDeck.decklist.sorceries.forEach( ( sorcery ) => {
            count += sorcery.qty;
        } );
        return count;
    },
    deckInstants( state ) {
        return state.fetchedDeck.decklist.instants;
    },
    deckInstantCount( state ) {
        let count = 0;
        state.fetchedDeck.decklist.instants.forEach( ( instant ) => {
            count += instant.qty;
        } );
        return count;
    },
    deckPlaneswalker( state ) {
        return state.fetchedDeck.decklist.planeswalker;
    },
    deckPlaneswalkerCount( state ) {
        let count = 0;
        state.fetchedDeck.decklist.planeswalker.forEach( ( planeswalker ) => {
            count += planeswalker.qty;
        } );
        return count;
    },
    deckEnchantments( state ) {
        return state.fetchedDeck.decklist.enchantments;
    },
    deckEnchantmentCount( state ) {
        let count = 0;
        state.fetchedDeck.decklist.enchantments.forEach( ( enchantment ) => {
            count += enchantment.qty;
        } );
        return count;
    },
    deckBasiclands( state ) {
        return state.fetchedDeck.decklist.basiclands;
    },
    deckBasiclandCount( state ) {
        let count = 0;
        count += state.fetchedDeck.decklist.basiclands.mountains;
        count += state.fetchedDeck.decklist.basiclands.plains;
        count += state.fetchedDeck.decklist.basiclands.islands;
        count += state.fetchedDeck.decklist.basiclands.forests;
        count += state.fetchedDeck.decklist.basiclands.swamps;
        return count;
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

        for ( const artifact of state.fetchedDeck.decklist.artifacts ) {
            artifactSum += artifact.qty;
        }
        for ( const creature of state.fetchedDeck.decklist.creatures ) {
            creatureSum += creature.qty;
        }
        for ( const enchantment of state.fetchedDeck.decklist.enchantments ) {
            enchantmentSum += enchantment.qty;
        }
        for ( const instant of state.fetchedDeck.decklist.instants ) {
            instantSum += instant.qty;
        }
        for ( const sorcery of state.fetchedDeck.decklist.sorceries ) {
            sorcerySum += sorcery.qty;
        }
        for ( const planeswalker of state.fetchedDeck.decklist.planeswalker ) {
            planeswalkerSum += planeswalker.qty;
        }
        for ( const land of state.fetchedDeck.decklist.lands ) {
            landSum += land.qty;
        }

        basicLandSum = state.fetchedDeck.decklist.basiclands.mountains + state.fetchedDeck.decklist.basiclands.plains + state.fetchedDeck.decklist.basiclands.forests + state.fetchedDeck.decklist.basiclands.islands + state.fetchedDeck.decklist.basiclands.swamps;

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
        state.fetchedDeck.likes = JSON.parse( payload.likes );
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
