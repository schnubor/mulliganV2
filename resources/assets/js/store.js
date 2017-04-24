import Vue from 'vue';
import Vuex from 'vuex';

Vue.use( Vuex );

export const store = new Vuex.Store( {
    state : {
        cardlist    : [],
        error       : 'Please search for cards or set filters above.',
        apiError   : false,
        maxResults  : 360,
        pagination  : {
            currentPage : 1,
            pageSize    : 12,
            totalPages  : null
        },
        decklist : {
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
        },
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
    },
    getters : {
        apiError( state ) {
            return state.apiError;
        },
        pageSize( state ) {
            return state.pagination.pageSize;
        },
        totalPages( state ) {
            return state.pagination.totalPages;
        },
        currentPage( state ) {
            return state.pagination.currentPage;
        },
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
    },
    mutations : {
        setAPIError( state, payload ) {
            state.apiError = payload.error;
        },
        setError( state, payload ) {
            state.error = payload.error;
        },
        setTotalPages( state, payload ) {
            state.pagination.totalPages = payload.total;
        },
        setNextPage( state ) {
            state.pagination.currentPage++;
        },
        setPrevPage( state ) {
            state.pagination.currentPage--;
        },
        addResult( state, payload ) {
            state.cardlist.push( payload.card );
        }
    },
    actions : {
        setAPIError( context, payload ) {
            context.commit( {
                type    : 'setAPIError',
                error   : payload.error
            } );
        },
        setError( context, payload ) {
            context.commit( {
                type    : 'setError',
                error   : payload.error
            } );
        },
        setTotalPages( context, payload ) {
            context.commit( {
                type    : 'setTotalPages',
                total   : payload.total
            } );
        },
        setNextPage( context ) {
            context.commit( {
                type : 'setNextPage'
            } );
        },
        setPrevPage( context ) {
            context.commit( {
                type : 'setPrevPage'
            } );
        },
        addResult( context, payload ) {
            context.commit( {
                type : 'addResult',
                card : payload.card
            } );
        },
        addCard( context, payload ) {
            console.log( payload );
        }
    }
} );
