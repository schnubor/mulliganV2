<template>
    <div>

        <span class="tag is-primary is-large">{{ cardSum }} Cards</span>
        
        <aside class="menu" style="margin-top: 1.5em;">
            <template v-if="creatures.length">
                <p class="menu-label">
                    Creatures
                </p>
                <ul class="menu-list">
                    <template v-for="creature in creatures">
                        <Decklistitem :entry="creature" :qty="creature.qty"></Decklistitem>
                    </template>
                </ul>
            </template>

            <template v-if="planeswalker.length">
                <p class="menu-label">
                    Planeswalker
                </p>
                <ul class="menu-list">
                    <template v-for="planeswalker in planeswalkers">
                        <Decklistitem :entry="planeswalker" :qty="planeswalker.qty"></Decklistitem>
                    </template>
                </ul>
            </template>

            <template v-if="artifacts.length">
                <p class="menu-label">
                    Artifacts
                </p>
                <ul class="menu-list">
                    <template v-for="artifact in artifacts">
                        <Decklistitem :entry="artifact" :qty="artifact.qty"></Decklistitem>
                    </template>
                </ul>
            </template>

            <template v-if="instants.length">
                <p class="menu-label">
                    Instants
                </p>
                <ul class="menu-list">
                    <template v-for="instant in instants">
                        <Decklistitem :entry="instant" :qty="instant.qty"></Decklistitem>
                    </template>
                </ul>
            </template>

            <template v-if="sorceries.length">
                <p class="menu-label">
                    Sorceries
                </p>
                <ul class="menu-list">
                    <template v-for="sorcery in sorceries">
                        <Decklistitem :entry="sorcery" :qty="sorcery.qty"></Decklistitem>
                    </template>
                </ul>
            </template>

            <template v-if="enchantments.length">
                <p class="menu-label">
                    Enchantments
                </p>
                <ul class="menu-list">
                    <template v-for="enchantment in enchantments">
                        <Decklistitem :entry="enchantment" :qty="enchantment.qty"></Decklistitem>
                    </template>
                </ul>
            </template>

            <p class="menu-label">
                Lands
            </p>
            <ul class="menu-list">
                <template v-for="land in lands">
                    <Decklistitem :entry="land" :qty="land.qty"></Decklistitem>
                </template>
                <li><a>Add Basic Lands</a></li>
            </ul>
        </aside>
    </div>
</template>

<script>
    import Spinner from './Spinner.vue';
    import Decklistitem from './Decklistitem.vue';
    import Store from './store.js';

    export default {
        data() {
            return {
                shared : Store
            };
        },
        components : {
            Spinner,
            Decklistitem
        },
        computed : {
            artifacts() {
                return this.shared.decklist.artifacts;
            },
            creatures() {
                return this.shared.decklist.creatures;
            },
            enchantments() {
                return this.shared.decklist.enchantments;
            },
            instants() {
                return this.shared.decklist.instants;
            },
            sorceries() {
                return this.shared.decklist.sorceries;
            },
            planeswalker() {
                return this.shared.decklist.planeswalker;
            },
            lands() {
                return this.shared.decklist.lands;
            },
            cardSum() {
                return this.artifacts.length +
                       this.creatures.length +
                       this.planeswalker.length +
                       this.enchantments.length +
                       this.instants.length +
                       this.sorceries.length +
                       this.lands.length;
            }
        }
    };
</script>

<style lang="scss">
    
</style>