<template>
    <div class="columns">
        <div class="column is-one-quarter">
            <Deckmenu></Deckmenu>
        </div>
        <div class="column">
            <div class="columns is-multiline">
                <Decklistvisual v-for="creature in decklist.creatures.main" :entry="creature" :key="creature.name"></Decklistvisual>
                <Decklistvisual v-for="instant in decklist.instants.main" :entry="instant" :key="instant.name"></Decklistvisual>
                <Decklistvisual v-for="sorcery in decklist.sorceries.main" :entry="sorcery" :key="sorcery.name"></Decklistvisual>
                <Decklistvisual v-for="enchantment in decklist.enchantments.main" :entry="enchantment" :key="enchantment.name"></Decklistvisual>
                <Decklistvisual v-for="artifact in decklist.artifacts.main" :entry="artifact" :key="artifact.name"></Decklistvisual>
                <Decklistvisual v-for="planeswalker in decklist.planeswalker.main" :entry="planeswalker":key="planeswalker.name"></Decklistvisual>
                <Decklistvisual v-for="land in decklist.lands.main" :entry="land" :key="land.name"></Decklistvisual>
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
