<template>
    <div class="field has-addons">
        <p class="control">
            <a class="button" :class="{ 'is-disabled' : !hasCards }">
                <span class="icon ">
                    <i class="fa fa-save"></i>
                </span>
                <span>Save</span>
            </a>
        </p>
        <p class="control">
            <a class="button" :class="{ 'is-disabled' : !hasCards }">
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
        }
    };
</script>

<style lang="scss">
    
</style>