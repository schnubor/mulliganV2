<template>
    <div>
        <StarthandItem v-for="card in starthand" :card="card" :key="card.id"></StarthandItem>
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

