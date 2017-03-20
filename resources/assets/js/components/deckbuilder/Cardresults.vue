<template>
    <div class="column">
        <div class="tabs">
            <ul>
                <li class="is-active"><a>All</a></li>
                <li><a>Standard</a></li>
                <li><a>Modern</a></li>
                <li><a>Legacy/Vintage</a></li>
            </ul>
        </div>
        <div class="column">
            <div class="columns" v-for="group in chunkedPage">
                <div class="column is-3" v-for="card in group" :key="card.id">
                    <Card :card="card"></Card>
                </div>
            </div>
        </div>
        <hr>
        <nav class="pagination">
            <a class="pagination-previous">Previous</a>
            <a class="pagination-next">Next page</a>
            <ul class="pagination-list">
                <li>
                    <a class="pagination-link">1</a>
                </li>
                <li>
                    <span class="pagination-ellipsis">&hellip;</span>
                </li>
                <li>
                    <a class="pagination-link">45</a>
                </li>
                <li>
                    <a class="pagination-link is-current">46</a>
                </li>
                <li>
                    <a class="pagination-link">47</a>
                </li>
                <li>
                    <span class="pagination-ellipsis">&hellip;</span>
                </li>
                <li>
                    <a class="pagination-link">86</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    import _ from 'lodash';
    import Card from './Singlecard.vue';

    export default {
        props : [
            'shared'
        ],
        components : {
            Card
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