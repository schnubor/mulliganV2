<template>
    <div>
        <div class="field has-addons">
            <p class="control">
                <button type="button" class="button" :disabled="!hasCards" @click="showSaveModal">
                    <span class="icon is-small">
                        <i class="fa fa-save"></i>
                    </span>
                    <span>Save</span>
                </button>
            </p>
            <p class="control">
                <button type="button" class="button" :disabled="!hasCards" @click="showStatsModal">
                    <span class="icon is-small">
                        <i class="fa fa-bar-chart"></i>
                    </span>
                    <span>Stats</span>
                </button>
            </p>
        </div>
        <hr></hr>
    </div>
</template>

<script>
    export default {
        computed : {
            hasCards() {
                return this.$store.getters.totalCardsMain > 0;
            }
        },
        methods : {
            showSaveModal() {
                this.$store.dispatch( {
                    type : 'showSaveModal'
                } );
            },
            showStatsModal() {
                this.$store.dispatch( {
                    type : 'showStatsModal'
                } );
            }
        }
    };
</script>

<style lang="scss">
</style>
