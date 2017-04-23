<template>
    <div class="column">
        <div>
            <span class="title">Search results ( {{ this.$store.state.cardlist.length }} Cards)</span>
            <hr>
        </div>
        <section class="section has-text-centered is-medium" v-if="isValidError">
            <p class="title errorMsg">
                {{ this.$store.state.error }}
            </p>
        </section>
        <div class="column">
            <div class="columns" v-for="group in chunkedPage">
                <div class="column is-3" v-for="card in group" :key="card.id">
                    <Card :card="card"></Card>
                </div>
            </div>
        </div>
        <Pagination :total="totalPages" :current="this.$store.state.pagination.currentPage" v-if="this.$store.state.cardlist.length"></Pagination>
    </div>
</template>

<script>
    import _ from 'lodash';
    import Card from './Singlecard.vue';
    import Pagination from './Pagination.vue';

    export default {
        components : {
            Card,
            Pagination
        },
        computed : {
            totalPages() {
                return Math.ceil( this.$store.state.cardlist.length / this.$store.state.pagination.pageSize );
            },
            cardPage() {
                const resultCount = this.$store.state.cardlist.length;
                let index = 0;
                let currentPage = this.$store.state.pagination.currentPage - 1;
                if ( resultCount !== 0 ) {
                    if ( this.$store.state.pagination.currentPage >= this.totalPages ) {
                        currentPage = this.totalPages - 1;
                    }
                }
                else {
                    currentPage = 0;
                }
                index = currentPage * this.$store.state.pagination.pageSize;
                return this.$store.state.cardlist.slice( index, index + this.$store.state.pagination.pageSize );
            },
            chunkedPage() {
                return _.chunk( this.cardPage, 4 );
            },
            isValidError() {
                return this.$store.state.error.length && ( !this.$store.state.cardlist.length || this.$store.state.cardlist.length > this.$store.state.maxResults );
            }
        }
    };
</script>

<style lang="scss">
    .errorMsg {
        color: #CCC;
    }
</style>
