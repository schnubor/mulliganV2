<template>
    <div>
        <p class="menu-label">Adding to</p>
        <span class="tag is-medium deckswitch" :class="activeList === 'main' ? 'is-primary' : 'is-light'" @click="switchActiveList( 'main' )">
            {{ totalCards.main }} Main
        </span>
        <span class="tag is-medium deckswitch" :class="activeList === 'sideboard' ? 'is-primary' : 'is-light'" @click="switchActiveList( 'sideboard' )">
            {{ totalCards.sideboard }} Sideboard
        </span>
        
        <aside class="menu" style="margin-top: 1.5em;">
            <template v-if="creatures[activeList].length">
                <p class="menu-label">
                    Creatures
                </p>
                <ul class="menu-list">
                    <template v-for="( creature, key ) in creatures[activeList]">
                        <Decklistitem :key="key" :entry="creature" list="creatures"></Decklistitem>
                    </template>
                </ul>
            </template>

            <template v-if="planeswalker[activeList].length">
                <p class="menu-label">
                    Planeswalker
                </p>
                <ul class="menu-list">
                    <template v-for="( planeswalker, key ) in planeswalker[activeList]">
                        <Decklistitem :key="key" :entry="planeswalker" list="planeswalker"></Decklistitem>
                    </template>
                </ul>
            </template>

            <template v-if="artifacts[activeList].length">
                <p class="menu-label">
                    Artifacts
                </p>
                <ul class="menu-list">
                    <template v-for="( artifact, key ) in artifacts[activeList]">
                        <Decklistitem :key="key" :entry="artifact" list="artifacts"></Decklistitem>
                    </template>
                </ul>
            </template>

            <template v-if="instants[activeList].length">
                <p class="menu-label">
                    Instants
                </p>
                <ul class="menu-list">
                    <template v-for="( instant, key ) in instants[activeList]">
                        <Decklistitem :key="key" :entry="instant" list="instants"></Decklistitem>
                    </template>
                </ul>
            </template>

            <template v-if="sorceries[activeList].length">
                <p class="menu-label">
                    Sorceries
                </p>
                <ul class="menu-list">
                    <template v-for="( sorcery, key ) in sorceries[activeList]">
                        <Decklistitem :key="key" :entry="sorcery" list="sorceries"></Decklistitem>
                    </template>
                </ul>
            </template>

            <template v-if="enchantments[activeList].length">
                <p class="menu-label">
                    Enchantments
                </p>
                <ul class="menu-list">
                    <template v-for="( enchantment, key ) in enchantments[activeList]">
                        <Decklistitem :key="key" :entry="enchantment" list="enchantments"></Decklistitem>
                    </template>
                </ul>
            </template>

            <p class="menu-label" v-if="lands[activeList].length">
                Lands
            </p>
            <ul class="menu-list">
                <template v-for="( land, key ) in lands[activeList]">
                    <Decklistitem :key="key" :entry="land" list="lands"></Decklistitem>
                </template>
            </ul>

            <p class="menu-label">
                Basic Lands
            </p>
            <ul class="menu-list">
                <li><a @click="showLandModal"><i class="ms ms-land ms-fw inline-icon"></i> Manage Basic Lands</a></li>
                <li>
                    <ul class="land-list">
                        <li>
                            <span><i class="ms ms-r ms-cost ms-fw"></i></span>
                            <span v-if="activeList === 'main'" class="tag">{{ this.basiclands.main.mountains }}</span>
                            <span v-if="activeList === 'sideboard'" class="tag">{{ this.basiclands.sideboard.mountains }}</span>
                            Mountains
                        </li>
                        <li>
                            <span><i class="ms ms-w ms-cost ms-fw"></i></span>
                            <span v-if="activeList === 'main'" class="tag">{{ this.basiclands.main.plains }}</span>
                            <span v-if="activeList === 'sideboard'" class="tag">{{ this.basiclands.sideboard.plains }}</span>
                            Plains
                        </li>
                        <li>
                            <span><i class="ms ms-g ms-cost ms-fw"></i></span>
                            <span v-if="activeList === 'main'" class="tag">{{ this.basiclands.main.forests }}</span>
                            <span v-if="activeList === 'sideboard'" class="tag">{{ this.basiclands.sideboard.forests }}</span>
                            Forests
                        </li>
                        <li>
                            <span><i class="ms ms-u ms-cost ms-fw"></i></span>
                            <span v-if="activeList === 'main'" class="tag">{{ this.basiclands.main.islands }}</span>
                            <span v-if="activeList === 'sideboard'" class="tag">{{ this.basiclands.sideboard.islands }}</span>
                            Islands
                        </li>
                        <li>
                            <span><i class="ms ms-b ms-cost ms-fw"></i></span>
                            <span v-if="activeList === 'main'" class="tag">{{ this.basiclands.main.swamps }}</span>
                            <span v-if="activeList === 'sideboard'" class="tag">{{ this.basiclands.sideboard.swamps }}</span>
                            Swamps
                        </li>
                    </ul>
                </li>
            </ul>
        </aside>
    </div>
</template>

<script>
    import Spinner from './../utils/Spinner.vue';
    import Decklistitem from './Decklistitem.vue';
    import { mapGetters } from 'vuex';

    export default {
        props: [ 'deckid' ],
        components : {
            Spinner,
            Decklistitem
        },
        mounted() {
            if( this.deckid ) {
                this.$store.dispatch( {
                    type : 'fetchDeckById',
                    id   : this.deckid
                } );
            }
        },
        methods : {
            showLandModal() {
                this.$store.dispatch( {
                    type    : 'showLandModal'
                } );
            },
            switchActiveList( list ) {
                this.$store.dispatch( {
                    type    : 'switchActiveList',
                    list    : list
                } );
            }
        },
        computed : {
            ...mapGetters( [
                'fetching',
                'lands',
                'artifacts',
                'creatures',
                'instants',
                'sorceries',
                'planeswalker',
                'enchantments',
                'basiclands',
                'totalCards',
                'activeList'
            ] )
        }
    };
</script>

<style lang="scss">
    .inline-icon {
        padding-right: 10px;
    }

    .land-list li {
        padding: 2px 0;
    }

    .deckswitch {
        cursor: pointer;
    }
</style>
