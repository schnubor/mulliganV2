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
    import Store from './store.js';

    export default {
        props    : [ 'total', 'current' ],
        data() {
            return {
                shared : Store
            };
        },
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
                this.shared.pagination.currentPage--;
            },
            nextPage() {
                this.shared.pagination.currentPage++;
            }
        }
    };
</script>
