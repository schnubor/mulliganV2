<template>
    <div>
        <div class="columns">
            <Decklistcolumn title="Creatures" :list="creatures"></Decklistcolumn>
            <Decklistcolumn title="Sorceries" :list="sorceries"></Decklistcolumn>
            <Decklistcolumn title="Instants" :list="instants"></Decklistcolumn>
            <Decklistcolumn title="Enchantments" :list="enchantments"></Decklistcolumn>
        </div>
        <div class="columns">
            <Decklistcolumn title="Artifacts" :list="artifacts"></Decklistcolumn>
            <Decklistcolumn title="Planeswalker" :list="planeswalker"></Decklistcolumn>
            <Decklistcolumn title="Lands" :list="lands"></Decklistcolumn>
        </div>
    </div>
</template>

<script>

import Decklistcolumn from './Decklistcolumn.vue';

export default {
    components : {
        Decklistcolumn
    },
    computed   : {
        creatures() {
            return this.$store.getters.deckCreatures;
        },
        sorceries() {
            return this.$store.getters.deckSorceries;
        },
        instants() {
            return this.$store.getters.deckInstants;
        },
        enchantments() {
            return this.$store.getters.deckEnchantments;
        },
        artifacts() {
            return this.$store.getters.deckArtifacts;
        },
        planeswalker() {
            return this.$store.getters.deckPlaneswalker;
        },
        lands() {
            return this.$store.getters.deckLands;
        }
    }
};
</script>

