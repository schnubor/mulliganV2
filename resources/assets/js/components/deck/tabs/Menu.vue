<template>
    <aside class="menu">
        
        <!-- Creatures -->
        <DecklistMenuitem v-if="creatures.length" headline="Creatures" :cards="creatures"></DecklistMenuitem>
        <!-- Sorceries -->
        <DecklistMenuitem v-if="sorceries.length" headline="Sorceries" :cards="sorceries"></DecklistMenuitem>
        <!-- Instants -->
        <DecklistMenuitem v-if="instants.length" headline="Instants" :cards="instants"></DecklistMenuitem>
        <!-- Enchantments -->
        <DecklistMenuitem v-if="enchantments.length" headline="Enchantments" :cards="enchantments"></DecklistMenuitem>
        <!-- Artifacts -->
        <DecklistMenuitem v-if="artifacts.length" headline="Artifacts" :cards="artifacts"></DecklistMenuitem>
        <!-- Planeswalker -->
        <DecklistMenuitem v-if="planeswalker.length" headline="Planeswalker" :cards="planeswalker"></DecklistMenuitem>
        <!-- Lands -->
        <DecklistMenuitem v-if="lands.length" headline="Lands" :cards="lands"></DecklistMenuitem>
        <!-- Basic Lands -->
        <template v-if="hasBasicLands">
            <p class="menu-label">
                Basiclands
            </p>
            <ul class="menu-list">
                <li v-if="basiclands.mountains">
                    <a>
                        <span class="tag">{{ basiclands.mountains }}</span>
                        <i class="ms ms-r ms-cost"></i> Mountains
                    </a>
                </li>
                <li v-if="basiclands.plains">
                    <a>
                        <span class="tag">{{ basiclands.plains }}</span>
                        <i class="ms ms-w ms-cost"></i> Plains
                    </a>
                </li>
                <li v-if="basiclands.forests">
                    <a>
                        <span class="tag">{{ basiclands.forests }}</span>
                        <i class="ms ms-g ms-cost"></i> Forests
                    </a>
                </li>
                <li v-if="basiclands.islands">
                    <a>
                        <span class="tag">{{ basiclands.islands }}</span>
                        <i class="ms ms-u ms-cost"></i> Islands
                    </a>
                </li>
                <li v-if="basiclands.swamps">
                    <a>
                        <span class="tag">{{ basiclands.swamps }}</span>
                        <i class="ms ms-b ms-cost"></i> Swamps
                    </a>
                </li>
            </ul>
        </template>
    </aside>
</template>

<script>
import DecklistMenuitem from './Menuitem.vue';

export default {
    props: [ 'isSideboard' ],
    methods : {
        showCardModal( card ) {
            this.$store.dispatch( {
                type    : 'showCardModal',
                card    : card
            } );
        }
    },
    components : {
        DecklistMenuitem
    },
    computed   : {
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
        basiclands() {
            if ( this.isSideboard ) {
                return this.decklist.basiclands.sideboard;
            } else {
                return this.decklist.basiclands.main;
            }
        },
        decklist() {
            return this.$store.getters.deckDecklist;
        },
        hasBasicLands() {
            return this.basiclands.mountains ||
                   this.basiclands.forests ||
                   this.basiclands.plains ||
                   this.basiclands.islands ||
                   this.basiclands.swamps;
        }
    }
};
</script>
