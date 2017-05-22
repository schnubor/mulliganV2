<template>
    <div class="column">
        <div>
            <span class="title">Search results ( {{ totalResults }} Cards)</span>
            <hr>
        </div>
        <section class="section has-text-centered is-medium" v-if="searching">
            <Spinner></Spinner>
        </section>
        <section class="section has-text-centered is-medium" v-if="isValidError">
            <p class="title errorMsg">
                {{ this.$store.getters.searchError }}
            </p>
        </section>
        <div class="column" v-show="!searching">
            <div class="columns" v-for="group in chunkedPage">
                <div class="column is-3" v-for="card in group" :key="card.id">
                    <Card :card="card"></Card>
                </div>
            </div>
        </div>
        <Pagination v-if="totalResults" v-show="!searching"></Pagination>
    </div>
</template>

<script>
    import _ from 'lodash';
    import Card from './Singlecard.vue';
    import Pagination from './Pagination.vue';
    import Spinner from './../utils/Spinner.vue';

    export default {
        components : {
            Card,
            Pagination,
            Spinner
        },
        computed : {
            searching() {
                return this.$store.getters.searching;
            },
            totalResults() {
                return this.$store.getters.totalResults;
            },
            totalPages() {
                return Math.ceil( this.totalResults / this.$store.getters.pageSize );
            },
            cardPage() {
                const resultCount = this.totalResults;
                let index = 0;
                let currentPage = this.$store.getters.currentPage - 1;
                if ( resultCount !== 0 ) {
                    if ( this.$store.getters.currentPage >= this.totalPages ) {
                        currentPage = this.totalPages - 1;
                    }
                }
                else {
                    currentPage = 0;
                }
                index = currentPage * this.$store.getters.pageSize;
                return this.$store.getters.cardlist.slice( index, index + this.$store.getters.pageSize );
            },
            chunkedPage() {
                return _.chunk( this.cardPage, 4 );
            },
            isValidError() {
                return this.$store.getters.isValidError;
            }
        }
    };
</script>

<style lang="scss">
    .errorMsg {
        color: #CCC;
    }
</style>
