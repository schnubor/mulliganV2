<template>
    <div>
        <hr>
        <nav class="pagination">
            <a class="pagination-previous" :disabled="isFirstPage" @click="prevPage">Previous</a>
            <a class="pagination-next" :disabled="isLastPage" @click="nextPage">Next page</a>
            <ul class="pagination-list">
                <p>Page {{ currentPage }} of {{ totalPages }}</p>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        computed : {
            currentPage() {
                return this.$store.getters.currentPage;
            },
            totalPages() {
                return this.$store.getters.totalPages;
            },
            isFirstPage() {
                if ( this.currentPage === 1 ) {
                    return true;
                }
                return false;
            },
            isLastPage() {
                if ( this.currentPage === this.totalPages ) {
                    return true;
                }
                return false;
            }
        },
        methods : {
            prevPage() {
                this.$store.dispatch( {
                    type : 'setPrevPage'
                } );
            },
            nextPage() {
                this.$store.dispatch( {
                    type : 'setNextPage'
                } );
            }
        }
    };
</script>
