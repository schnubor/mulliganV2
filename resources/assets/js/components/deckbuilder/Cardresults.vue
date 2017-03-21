<template>
    <div class="column">
        <div>
            <span class="title">Search results</span>
            <hr>
        </div>
        <div class="column">
            <div class="columns" v-for="group in chunkedPage">
                <div class="column is-3" v-for="card in group" :key="card.id">
                    <Card :card="card"></Card>
                </div>
            </div>
        </div>
        <hr>
        <Pagination></Pagination>
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
            }
        }
    };
</script>

<style lang="scss">
    
</style>