<template>
    <section id="quicksearch" class="section is-medium has-text-centered">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-one-quarter">
                    <p class="control has-icon" :class="{ 'is-loading' : isLoading }">
                        <input class="input is-large is-expanded" type="text" placeholder="Find a card" v-model="searchQuery" v-on:keyup="getSearchDebounced">
                        <span class="icon">
                            <i class="fa fa-search"></i>
                        </span>
                    </p>
                    <div class="box" v-if="showBox">
                        <p v-if="results.length == 0">No results.</p>
                        <table class="table" style="margin-bottom: 0" v-if="results.length">
                            <tbody>
                                <template v-for="result in results">
                                    <QuicksearchResult :result="result"></QuicksearchResult>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import QuicksearchResult from './QuicksearchResult.vue';
    import _ from 'lodash';
    import axios from 'axios';

    export default {
        data() {
            return {
                searchQuery : '',
                results : [],
                showBox : false,
                isLoading : false
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

                    axios.get( this.searchUrl )
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
                        this.isLoading = false;
                    } )
                    .catch( ( error ) => {
                        console.warn( error );

                        // set loading state
                        this.isLoading = false;
                    } );
                }
                else {
                    this.showBox = false;
                }
            }, 200 )
        }
        
    }
</script>

<style>
    .control.has-icon .input.is-large + .icon {
        top: 1.65rem;
    }
</style>