<template>
    <div>
        <hr>
        <nav class="pagination">
            <a class="pagination-previous" :class="{ 'is-disabled' : isFirstPage }" @click="prevPage">Previous</a>
            <a class="pagination-next" :class="{ 'is-disabled' : isLastPage }" @click="nextPage">Next page</a>
            <ul class="pagination-list">
                <p>Page {{ current }} of {{ total }}</p>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        props    : [ 'total', 'current' ],
        computed : {
            isFirstPage() {
                if ( this.current === 1 ) {
                    return true;
                }
                return false;
            },
            isLastPage() {
                if ( this.current === this.total ) {
                    return true;
                }
                return false;
            }
        },
        methods : {
            prevPage() {
                this.$store.state.pagination.currentPage--;
            },
            nextPage() {
                this.$store.state.pagination.currentPage++;
            }
        }
    };
</script>
