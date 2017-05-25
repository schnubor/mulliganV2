<template>
    <div class="columns">
        <div class="column is-one-quarter">
            <Deckmenu></Deckmenu>
        </div>
        <div class="columns is-multiline">
            <div class="column is-one-quarter">

            </div>
        </div>
    </div>
</template>

<script>

import Deckmenu from './Menu.vue';

export default {
    components : {
        Deckmenu
    },
    computed : {
        decklist() {
            return this.$store.getters.deckDecklist;
        }
    }
};
</script>

