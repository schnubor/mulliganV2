<template>
    <div class="column">
        <div>
            <span class="title">Search results ( {{ this.shared.cardlist.length }} Cards)</span>
            <hr>
        </div>
        <section class="section has-text-centered is-medium" v-if="isValidError">
            <p class="title errorMsg">
                {{ shared.error }}
            </p>
        </section>
        <div class="column">
            <div class="columns" v-for="group in chunkedPage">
                <div class="column is-3" v-for="card in group" :key="card.id">
                    <Card :card="card"></Card>
                </div>
            </div>
        </div>
        <Pagination :total="totalPages" :current="shared.pagination.currentPage" v-if="this.shared.cardlist.length"></Pagination>
    </div>
</template>

<script>
    import _ from 'lodash';
    import Card from './Singlecard.vue';
    import Pagination from './Pagination.vue';

    export default {
        props : [
            'shared'
        ],
        components : {
            Card,
            Pagination
        },
        computed : {
            totalPages() {
                return Math.ceil( this.shared.cardlist.length / this.shared.pagination.pageSize );
            },
            cardPage() {
                const resultCount = this.shared.cardlist.length;
                let index = 0;
                let currentPage = this.shared.pagination.currentPage - 1;
                if ( resultCount !== 0 ) {
                    if ( this.shared.pagination.currentPage >= this.totalPages ) {
                        currentPage = this.totalPages - 1;
                    }
                }
                else {
                    currentPage = 0;
                }
                index = currentPage * this.shared.pagination.pageSize;
                return this.shared.cardlist.slice( index, index + this.shared.pagination.pageSize );
            },
            chunkedPage() {
                return _.chunk( this.cardPage, 4 );
            },
            isValidError() {
                return this.shared.error.length && ( !this.shared.cardlist.length || this.shared.cardlist.length > this.shared.maxResults );
            }
        }
    };
</script>

<style lang="scss">
    .errorMsg {
        color: #CCC;
    }
</style>