<template>
    <div class="field has-addons">
        <p class="control">
            <a class="button" :class="{ 'is-disabled' : !hasCards }" @click="showSaveModal">
                <span class="icon ">
                    <i class="fa fa-save"></i>
                </span>
                <span>Save</span>
            </a>
        </p>
        <p class="control">
            <a class="button" :class="{ 'is-disabled' : !hasCards }" @click="showStatsModal">
                <span class="icon is-small">
                    <i class="fa fa-bar-chart"></i>
                </span>
                <span>Stats</span>
            </a>
        </p>
    </div>
</template>

<script>
    import Store from './store.js';

    export default {
        data() {
            return {
                shared : Store
            };
        },
        computed : {
            hasCards() {
                return this.shared.decklist.cardsum > 0;
            }
        },
        methods : {
            showSaveModal() {
                this.$emit( 'showsavemodal' );
            },
            showStatsModal() {
                this.$emit( 'showstatsmodal' );
            }
        }
    };
</script>

<style lang="scss">
    
</style>