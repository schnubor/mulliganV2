<template>
    <section class="hero is-light">
        <div class="hero-body">
            <div class="container">
                <div class="has-text-centered" v-if="loading">
                    <Spinner></Spinner>
                </div>
                <div v-if="!loading">
                    <div class="columns">
                        <div class="column is-4">
                            <p class="control">
                                <input class="input" type="text" placeholder="Card name" v-model="filters.name" :disabled="searching">
                            </p>
                        </div>
                        <div class="column">
                            <button class="mana-switch" :disabled="searching" :class="{ active: filters.colors.red }" @click="filters.colors.red = !filters.colors.red">
                                <i class="ms ms-r ms-cost ms-2x ms-fw"></i>
                            </button>
                            <button class="mana-switch" :disabled="searching" :class="{ active: filters.colors.white }" @click="filters.colors.white = !filters.colors.white">
                                <i class="ms ms-w ms-cost ms-2x ms-fw"></i>
                            </button>
                            <button class="mana-switch" :disabled="searching" :class="{ active: filters.colors.green }" @click="filters.colors.green = !filters.colors.green">
                                <i class="ms ms-g ms-cost ms-2x ms-fw"></i>
                            </button>
                            <button class="mana-switch" :disabled="searching" :class="{ active: filters.colors.black }" @click="filters.colors.black = !filters.colors.black">
                                <i class="ms ms-b ms-cost ms-2x ms-fw"></i>
                            </button>
                            <button class="mana-switch" :disabled="searching" :class="{ active: filters.colors.blue }" @click="filters.colors.blue = !filters.colors.blue">
                                <i class="ms ms-u ms-cost ms-2x ms-fw"></i>
                            </button>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column is-2">
                            <p class="control">
                                <span class="select is-fullwidth">
                                    <select v-model="filters.set" :disabled="searching">
                                        <option value="">Any Set</option>
                                        <option :value="set.code" v-for="set in setsReverted">{{ set.name }}</option>
                                    </select>
                                </span>
                            </p>
                        </div>
                        <div class="column is-2">
                            <p class="control">
                                <span class="select is-fullwidth">
                                    <select v-model="filters.mana" :disabled="searching">
                                        <option value="any">Any Mana Cost</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5+</option>
                                    </select>
                                </span>
                            </p>
                        </div>
                        <div class="column is-2">
                            <p class="control">
                                <span class="select is-fullwidth">
                                    <select v-model="filters.type" :disabled="searching">
                                        <option value="">Any Type</option>
                                        <option value="creature">Creature</option>
                                        <option value="instant">Instant</option>
                                        <option value="Sorcery">Sorcery</option>
                                        <option value="enchantment">Enchantment</option>
                                        <option value="Artifact">Artifact</option>
                                        <option value="Planeswalker">Planeswalker</option>
                                        <option value="Land">Land</option>
                                    </select>
                                </span>
                            </p>
                        </div>
                        <div class="column is-2">
                            <p class="control">
                                <span class="select is-fullwidth">
                                    <select v-model="filters.rarity" :disabled="searching">
                                        <option value="">Any Rarity</option>
                                        <option value="Mythic Rare">Mythic</option>
                                        <option value="Rare">Rare</option>
                                        <option value="Uncommon">Uncommon</option>
                                        <option value="Common">Common</option>
                                    </select>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import _ from 'lodash';
    import axios from 'axios';
    import Spinner from './Spinner.vue';
    import queryString from 'query-string';

    export default {
        data() {
            return {
                sets        : [],
                setsUrl     : 'https://api.magicthegathering.io/v1/sets',
                searchUrl   : 'https://api.magicthegathering.io/v1/cards?',
                loading     : true,
                searching   : false,
                fetched     : false,
                noresults   : false,
                toomany     : false,

                // Filters
                filters : {
                    set     : '',
                    mana    : 'any',
                    name    : '',
                    rarity  : '',
                    type    : '',
                    colors  : {
                        red   : false,
                        blue  : false,
                        green : false,
                        black : false,
                        white : false
                    }
                }
            };
        },
        computed : {
            setsReverted() {
                return this.sets.reverse();
            },
            colorsArray() {
                const colors = [];
                const filters = this.filters;
                for ( const color in filters.colors ) {
                    if ( filters.colors[ color ] ) colors.push( color );
                }
                return colors;
            },
            pageSize() {
                return this.$store.getters.pageSize;
            }
        },
        watch : {
            filters : {
                handler : function() {
                    this.search();
                },
                deep : true
            }
        },
        methods : {
            fetchPage( page, filters, colorsArray ) {
                const params = {};

                if ( filters.name ) params.name = filters.name;
                if ( filters.set ) params.set = filters.set;
                if ( filters.type ) params.types = filters.type;
                if ( filters.rarity ) params.rarity = filters.rarity;
                if ( filters.mana !== 'any' ) params.cmc = filters.mana;
                if ( filters.mana === '5' ) params.cmc = 'gte5';
                if ( colorsArray.length && filters.type !== 'land' ) params.colors = colorsArray.join( ',' );

                params.pageSize = this.pageSize;
                params.page = this.searchPage;

                const searchUri = this.searchUrl + queryString.stringify( params );

                const self = this;

                axios.get( searchUri, { timeout : 10000 } )
                .then( function( response ) {
                    // Get total count
                    const total = response.headers[ 'total-count' ];
                    const totalPages = Math.ceil( total / self.pageSize );

                    // update store
                    self.$store.dispatch( {
                        type    : 'setTotalPages',
                        total   : totalPages
                    } );

                    // Check for
                    if ( total < self.$store.state.maxResults ) {
                        // Fill cards
                        if ( response.data.cards.length ) {
                            self.$store.dispatch( {
                                type    : 'setError',
                                error   : ''
                            } );
                            for ( const card of response.data.cards ) {
                                if ( card.imageUrl && _.get( card, 'supertypes[0]' ) !== 'Basic' ) {
                                    self.$store.dispatch( {
                                        type : 'addResult',
                                        card : card
                                    } );
                                }
                            }
                        }
                        else {
                            self.cardlist = [];
                            self.$store.dispatch( {
                                type    : 'setError',
                                error   : 'No results. Try adjusting your filters.'
                            } );
                        }
                        // Fetch next page if necessary
                        if ( self.searchPage < totalPages ) {
                            self.searchPage++;
                            self.fetchPage( self.searchPage, filters, colorsArray );
                        }
                        else {
                            self.fetched = true;
                            self.searching = false;
                        }
                    }
                    else {
                        self.cardlist = [];
                        self.$store.dispatch( {
                            type    : 'setError',
                            error   : 'Too many results! Try adjusting the filters.'
                        } );
                        self.searching = false;
                    }
                } )
                .catch( ( error ) => {
                    self.cardlist = [];
                    self.searching = false;
                    self.$store.dispatch( {
                        type    : 'setError',
                        error   : 'Oops! Something went wrong. Please try again!'
                    } );
                    console.warn( error );
                } );
            },
            // Fetch all sets
            fetchSets() {
                const self = this;
                this.sets = [];
                this.loading = true;
                axios.get( this.setsUrl, { timeout : 10000 } )
                .then( function( response ) {
                    // Fill sets
                    self.sets = response.data.sets;
                    self.loading = false;
                } ).catch( ( error ) => {
                    console.warn( error );
                } );
            },
            search : _.debounce( function() {
                this.$store.state.pagination.currentPage = 1;
                this.$store.state.cardlist = [];
                this.$store.state.error = '';
                this.fetched = false;
                this.searching = true;
                this.searchPage = 1;

                this.fetchPage( this.searchPage, this.filters, this.colorsArray );
            }, 500 )
        },
        mounted() {
            this.fetchSets();
        },
        components : {
            Spinner
        }
    };
</script>

<style lang="scss">
    .mana-switch {
        background-color: transparent;
        border: none;
        display: inline-block;
        padding: 0 5px;
        cursor: pointer;
        opacity: .5;
        transition: .2s all;

        &.active{
            opacity: 1
        }

        &:focus {
            outline:0;
        }
    }
</style>
