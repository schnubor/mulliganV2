<template>
    <div class="columns">
        <div class="column is-one-quarter">
            <Deckmenu></Deckmenu>
        </div>
        <div class="column">
            <div class="columns is-multiline">
                <Decklistvisual v-for="creature in decklist.creatures" :entry="creature"></Decklistvisual>
                <Decklistvisual v-for="instant in decklist.instants" :entry="instant"></Decklistvisual>
                <Decklistvisual v-for="sorcery in decklist.sorceries" :entry="sorcery"></Decklistvisual>
                <Decklistvisual v-for="enchantment in decklist.enchantments" :entry="enchantment"></Decklistvisual>
                <Decklistvisual v-for="artifact in decklist.artifacts" :entry="artifact"></Decklistvisual>
                <Decklistvisual v-for="planeswalker in decklist.planeswalker" :entry="planeswalker"></Decklistvisual>
                <Decklistvisual v-for="land in decklist.lands" :entry="land"></Decklistvisual>
            </div>
        </div>
    </div>
</template>

<script>

import Deckmenu from './Menu.vue';
import Decklistvisual from './Decklistvisual.vue';

export default {
    components : {
        Deckmenu,
        Decklistvisual
    },
    computed : {
        decklist() {
            return this.$store.getters.deckDecklist;
        }
    }
};
</script>

<style lang="scss">
.cardContainer {
    position: relative;
}
</style>
