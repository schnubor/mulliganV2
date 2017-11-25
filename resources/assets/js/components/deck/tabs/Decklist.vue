<template>
    <div class="columns">
        <div class="column is-one-quarter">
            <Deckmenu :isSideboard="isSideboard"></Deckmenu>
        </div>
        <div class="column">
            <div class="columns is-multiline">
                <Decklistvisual v-for="creature in creatures" :entry="creature" :key="creature.name"></Decklistvisual>
                <Decklistvisual v-for="instant in instants" :entry="instant" :key="instant.name"></Decklistvisual>
                <Decklistvisual v-for="sorcery in sorceries" :entry="sorcery" :key="sorcery.name"></Decklistvisual>
                <Decklistvisual v-for="enchantment in enchantments" :entry="enchantment" :key="enchantment.name"></Decklistvisual>
                <Decklistvisual v-for="artifact in artifacts" :entry="artifact" :key="artifact.name"></Decklistvisual>
                <Decklistvisual v-for="planeswalker in planeswalker" :entry="planeswalker":key="planeswalker.name"></Decklistvisual>
                <Decklistvisual v-for="land in lands" :entry="land" :key="land.name"></Decklistvisual>
            </div>
        </div>
    </div>
</template>

<script>

import Deckmenu from './Menu.vue';
import Decklistvisual from './Decklistvisual.vue';

export default {
    props: [ 'isSideboard' ],
    components : {
        Deckmenu,
        Decklistvisual
    },
    computed : {
        creatures() {
            if ( this.isSideboard ) {
                return this.decklist.creatures.sideboard;
            } else {
                return this.decklist.creatures.main;
            }
        },
        instants() {
            if ( this.isSideboard ) {
                return this.decklist.instants.sideboard;
            } else {
                return this.decklist.instants.main;
            }
        },
        sorceries() {
            if ( this.isSideboard ) {
                return this.decklist.sorceries.sideboard;
            } else {
                return this.decklist.sorceries.main;
            }
        },
        enchantments() {
            if ( this.isSideboard ) {
                return this.decklist.enchantments.sideboard;
            } else {
                return this.decklist.enchantments.main;
            }
        },
        artifacts() {
            if ( this.isSideboard ) {
                return this.decklist.artifacts.sideboard;
            } else {
                return this.decklist.artifacts.main;
            }
        },
        planeswalker() {
            if ( this.isSideboard ) {
                return this.decklist.planeswalker.sideboard;
            } else {
                return this.decklist.planeswalker.main;
            }
        },
        lands() {
            if ( this.isSideboard ) {
                return this.decklist.lands.sideboard;
            } else {
                return this.decklist.lands.main;
            }
        },
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
