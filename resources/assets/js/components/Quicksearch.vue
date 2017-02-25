<template>
    <section id="quicksearch" class="section is-medium has-text-centered">
        <div class="container">
            <div class="columns">
                <div class="column is-half is-offset-one-quarter">
                    <p class="control has-icon has-icon-right">
                        <input class="input is-large is-expanded" type="text" placeholder="Find a card" v-model="searchQuery" v-on:keyup="getSearchDebounced">
                        <span class="icon">
                            <i class="fa fa-search"></i>
                        </span>
                    </p>
                    <div class="box">
                        <table class="table" style="margin-bottom: 0">
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
                results : []
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
                axios.get( this.searchUrl )
                .then( function( response ) {
                    self.results = response.data.cards
                } )
                .catch( ( error ) => {
                    console.warn( error );
                } );
            }, 200 )
        }
        
    }
</script>