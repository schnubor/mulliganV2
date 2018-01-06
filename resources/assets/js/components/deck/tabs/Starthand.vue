<template>
    <div class="columns is-multiline">
        <StarthandItem v-for="(card, index) in starthand" :card="card" :index="index" :key="card.id"></StarthandItem>
    </div>
</template>


<script>
import StarthandItem from './StarthandItem.vue';

export default {
    components : {
        StarthandItem
    },
    computed : {
        starthand() {
            return this.$store.getters.deckStarthand;
        }
    }
};
</script>

