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
                        <Decklistitem :entry="creature" list="creatures" @update="forceUpdate"></Decklistitem>
                    </template>
                </ul>
            </template>

            <template v-if="planeswalker.length">
                <p class="menu-label">
                    Planeswalker
                </p>
                <ul class="menu-list">
                    <template v-for="planeswalker in planeswalker">
                        <Decklistitem :entry="planeswalker" list="planeswalker" @update="forceUpdate"></Decklistitem>
                    </template>
                </ul>
            </template>

            <template v-if="artifacts.length">
                <p class="menu-label">
                    Artifacts
                </p>
                <ul class="menu-list">
                    <template v-for="artifact in artifacts">
                        <Decklistitem :entry="artifact" list="artifacts" @update="forceUpdate"></Decklistitem>
                    </template>
                </ul>
            </template>

            <template v-if="instants.length">
                <p class="menu-label">
                    Instants
                </p>
                <ul class="menu-list">
                    <template v-for="instant in instants">
                        <Decklistitem :entry="instant" list="instants" @update="forceUpdate"></Decklistitem>
                    </template>
                </ul>
            </template>

            <template v-if="sorceries.length">
                <p class="menu-label">
                    Sorceries
                </p>
                <ul class="menu-list">
                    <template v-for="sorcery in sorceries">
                        <Decklistitem :entry="sorcery" list="sorceries" @update="forceUpdate"></Decklistitem>
                    </template>
                </ul>
            </template>

            <template v-if="enchantments.length">
                <p class="menu-label">
                    Enchantments
                </p>
                <ul class="menu-list">
                    <template v-for="enchantment in enchantments">
                        <Decklistitem :entry="enchantment" list="enchantments" @update="forceUpdate"></Decklistitem>
                    </template>
                </ul>
            </template>

            <p class="menu-label" v-if="lands.length">
                Lands
            </p>
            <ul class="menu-list">
                <template v-for="land in lands">
                    <Decklistitem :entry="land" list="lands" @update="forceUpdate"></Decklistitem>
                </template>
            </ul>

            <p class="menu-label">
                Basic Lands
            </p>
            <ul class="menu-list">
                <li><a @click="showLandModal"><i class="ms ms-land ms-fw inline-icon"></i> Manage Basic Lands</a></li>
                <li>
                    <ul>
                        <li>
                            <span><i class="ms ms-r ms-cost ms-fw"></i></span>
                            <span class="tag">{{ this.basiclands.mountains }}</span>
                            Mountains
                        </li>
                        <li>
                            <span><i class="ms ms-w ms-cost ms-fw"></i></span>
                            <span class="tag">{{ this.basiclands.plains }}</span>
                            Plains
                        </li>
                        <li>
                            <span><i class="ms ms-g ms-cost ms-fw"></i></span>
                            <span class="tag">{{ this.basiclands.forests }}</span>
                            Forests
                        </li>
                        <li>
                            <span><i class="ms ms-u ms-cost ms-fw"></i></span>
                            <span class="tag">{{ this.basiclands.islands }}</span>
                            Islands
                        </li>
                        <li>
                            <span><i class="ms ms-b ms-cost ms-fw"></i></span>
                            <span class="tag">{{ this.basiclands.swamps }}</span>
                            Swamps
                        </li>
                    </ul>
                </li>
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
                shared        : Store
            };
        },
        components : {
            Spinner,
            Decklistitem
        },
        methods : {
            forceUpdate() {
                this.$forceUpdate();
            },
            showLandModal() {
                this.$emit( 'showlandmodal' );
            }
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
            basiclands() {
                return this.shared.decklist.basiclands;
            },
            cardSum() {
                let artifactSum = 0;
                let creatureSum = 0;
                let enchantmentSum = 0;
                let instantSum = 0;
                let sorcerySum = 0;
                let planeswalkerSum = 0;
                let landSum = 0;
                let basicLandSum = 0;
                let cardSum = 0;

                for ( const artifact of this.artifacts ) {
                    artifactSum += artifact.qty;
                }
                for ( const creature of this.creatures ) {
                    creatureSum += creature.qty;
                }
                for ( const enchantment of this.enchantments ) {
                    enchantmentSum += enchantment.qty;
                }
                for ( const instant of this.instants ) {
                    instantSum += instant.qty;
                }
                for ( const sorcery of this.sorceries ) {
                    sorcerySum += sorcery.qty;
                }
                for ( const planeswalker of this.planeswalker ) {
                    planeswalkerSum += planeswalker.qty;
                }
                for ( const land of this.lands ) {
                    landSum += land.qty;
                }

                basicLandSum = this.basiclands.mountains + this.basiclands.plains + this.basiclands.forests + this.basiclands.islands + this.basiclands.swamps;

                cardSum = artifactSum + creatureSum + enchantmentSum + instantSum + sorcerySum + planeswalkerSum + landSum + basicLandSum;

                this.shared.decklist.cardsum = cardSum;

                return cardSum;
            }
        }
    };
</script>

<style lang="scss">
    .inline-icon {
        padding-right: 10px;
    }
</style>