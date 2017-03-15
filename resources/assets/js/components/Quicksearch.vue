<template>
    <div class="container">
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                <p class="control has-icon" :class="{ 'is-loading' : isLoading }">
                    <input class="input is-large is-expanded" type="text" :placeholder="placeholdertext" v-model="searchQuery" v-on:keyup="getSearchDebounced">
                    <span class="icon">
                        <i class="fa fa-search"></i>
                    </span>
                </p>
                <div class="notification is-warning" v-if="showError">
                    <button class="delete" v-on:click="hideError"></button>
                    Whoops, seems like my <a :href="searchUrl" target="_blank"><strong>source of data</strong></a> is very slow or offline.
                </div>
                <div class="box" v-if="showBox">
                    <p v-if="results.length == 0">No results.</p>
                    <table class="table is-marginless" v-if="results.length">
                        <tbody>
                            <template v-for="(result, index) in results">
                                <QuicksearchResult 
                                :result="result" 
                                v-on:mouseenter.native="showPreview( result )"
                                v-on:mouseleave.native="hidePreview">
                                </QuicksearchResult>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="column" v-if="previewImg.length">
                <div class="box">
                    <img :src="previewImg" alt="card preview" class="card" :class="previewImgRarity">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import QuicksearchResult from './QuicksearchResult.vue';
    import _ from 'lodash';
    import axios from 'axios';

    export default {
        props : {
            placeholdertext : {
                type : String,
                default: "Find a card"
            }
        },
        data() {
            return {
                searchQuery         : '',
                results             : [],
                showBox             : false,
                showError           : false,
                isLoading           : false,
                previewImg          : '',
                previewImgRarity    : ''
            }
        },
        computed : {
            searchUrl() {
                return `https://api.magicthegathering.io/v1/cards?name=${this.searchQuery}&page=1&pageSize=10`;
            }
        },
        components : {
            QuicksearchResult
        },
        methods: {
            getSearchDebounced : _.debounce( function() {
                const self = this;

                // Fetch search results
                if( this.searchQuery.length > 3 ){
                    // set loading state
                    this.isLoading = true;

                    // hide error message
                    self.showError = false;

                    axios.get( this.searchUrl, { timeout : 10000 } )
                    .then( function( response ) {
                        self.results = [];
                        for( const card of response.data.cards ) {
                            if ( card.manaCost && card.imageUrl ) {
                                self.results.push( card );
                            }
                        }

                        // show search result box
                        self.showBox = true;

                        // set loading state
                        self.isLoading = false;
                    } )
                    .catch( ( error ) => {
                        console.warn( error );

                        // show error message
                        self.showError = true;

                        // set loading state
                        self.isLoading = false;
                    } );
                }
                else {
                    this.showBox = false;
                    this.hidePreview();
                }
            }, 200 ),

            showPreview( result ) {
                this.previewImg = result.imageUrl;
                switch( result.rarity ) {
                    case 'Mythic Rare': 
                        this.previewImgRarity = 'mythic';
                        break;
                    case 'Rare': 
                        this.previewImgRarity = 'rare';
                        break;
                    case 'Uncommon': 
                        this.previewImgRarity = 'uncommon';
                        break;
                    default: 
                        this.previewImgRarity = 'common';
                        break;
                }
            },

            hidePreview() {
                this.previewImg = '';
            },

            hideError() {
                this.showError = false;
            }
        }
        
    }
</script>

<style lang="scss">
    @import "./../../sass/variables";

    .control.has-icon .input.is-large + .icon {
        top: 1.65rem;
    }

    .card {
        border-radius: 16px;

        &.common {
            border: 6px solid $common;
            background-color: $common;
        }
        &.uncommon {
            border: 6px solid $uncommon;
            background-color: $uncommon;
        }
        &.rare {
            border: 6px solid $rare;
            background-color: $rare;
        }
        &.mythic {
            border: 6px solid $mythic;
            background-color: $mythic;
        }
    }
</style>