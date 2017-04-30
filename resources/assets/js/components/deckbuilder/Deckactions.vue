<template>
    <div class="field has-addons">
        <p class="control">
            <a class="button" :disabled="!hasCards" @click="showSaveModal">
                <span class="icon is-small">
                    <i class="fa fa-save"></i>
                </span>
                <span>Save</span>
            </a>
        </p>
        <p class="control">
            <a class="button" :disabled="!hasCards" @click="showStatsModal">
                <span class="icon is-small">
                    <i class="fa fa-bar-chart"></i>
                </span>
                <span>Stats</span>
            </a>
        </p>
    </div>
</template>

<script>
    export default {
        computed : {
            hasCards() {
                return this.$store.getters.totalCards > 0;
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
