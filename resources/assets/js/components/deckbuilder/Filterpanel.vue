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
                                <input class="input" type="email" placeholder="Card name" v-model="filters.name">
                            </p>
                        </div>
                        <div class="column">
                            <div class="mana-switch" :class="{ active: filters.colors.red }" @click="filters.colors.red = !filters.colors.red">
                                <i class="ms ms-r ms-cost ms-2x ms-fw"></i>
                            </div>
                            <div class="mana-switch" :class="{ active: filters.colors.white }" @click="filters.colors.white = !filters.colors.white">
                                <i class="ms ms-w ms-cost ms-2x ms-fw"></i>
                            </div>
                            <div class="mana-switch" :class="{ active: filters.colors.green }" @click="filters.colors.green = !filters.colors.green">
                                <i class="ms ms-g ms-cost ms-2x ms-fw"></i>
                            </div>
                            <div class="mana-switch" :class="{ active: filters.colors.black }" @click="filters.colors.black = !filters.colors.black">
                                <i class="ms ms-b ms-cost ms-2x ms-fw"></i>
                            </div>
                            <div class="mana-switch" :class="{ active: filters.colors.blue }" @click="filters.colors.blue = !filters.colors.blue">
                                <i class="ms ms-u ms-cost ms-2x ms-fw"></i>
                            </div>
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column is-2">
                            <p class="control">
                                <span class="select is-fullwidth">
                                    <select v-model="filters.set">
                                        <option value="">Any Set</option>
                                        <option :value="set.code" v-for="set in setsReverted">{{ set.name }}</option>
                                    </select>
                                </span>
                            </p>
                        </div>
                        <div class="column is-2">
                            <p class="control">
                                <span class="select is-fullwidth">
                                    <select v-model="filters.mana">
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
                                    <select v-model="filters.type">
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
                                    <select v-model="filters.rarity">
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
    import Store from './store.js';

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
                },

                // Store
                shared : Store
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
            fetchPage( page ) {
                const params = {};

                if ( this.filters.name ) params.name = this.filters.name;
                if ( this.filters.set ) params.set = this.filters.set;
                if ( this.filters.type ) params.types = this.filters.type;
                if ( this.filters.rarity ) params.rarity = this.filters.rarity;
                if ( this.filters.mana !== 'any' ) params.cmc = this.filters.mana;
                if ( this.filters.mana === '5' ) params.cmc = 'gte5';
                if ( this.colorsArray.length && this.filters.type !== 'land' ) params.colors = this.colorsArray.join( ',' );

                params.pageSize = this.shared.pagination.pageSize;
                params.page = page;

                const searchUri = this.searchUrl + queryString.stringify( params );
                console.log( searchUri );

                const self = this;

                axios.get( searchUri, { timeout : 10000 } )
                .then( function( response ) {
                    console.log( response );
                    // Get total count
                    const total = response.headers[ 'total-count' ];
                    const totalPages = Math.ceil( total / self.shared.pagination.pageSize );
                    // Check for
                    if ( total < 300 ) {
                        // Fill cards
                        if ( response.data.cards.length ) {
                            for ( const card of response.data.cards ) {
                                if ( card.imageUrl ) self.shared.cardlist.push( card );
                            }
                        }
                        else {
                            self.noresults = true;
                        }
                        // Fetch next page if necessary
                        if ( page < totalPages ) {
                            page++;
                            self.fetchPage( page );
                        }
                        else {
                            self.fetched = true;
                            self.searching = false;
                        }
                    }
                    else {
                        self.toomany = true;
                        self.searching = false;
                    }
                } )
                .catch( ( error ) => {
                    self.searching = false;
                    self.error = true;
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
                this.shared.pagination.currentPage = 1;
                this.shared.cardlist = [];
                this.fetched = false;
                this.searching = true;
                this.noresults = false;
                this.toomany = false;

                this.fetchPage( 1 );
            }, 200 )
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
        display: inline-block;
        padding: 0 5px;
        cursor: pointer;
        opacity: .5;
        transition: .2s all;

        &.active{
            opacity: 1
        }
    }
</style>