<template>
    <aside class="menu">
        <!-- Creatures -->
        <template v-if="creatures.length">
            <p class="menu-label">
                Creatures
            </p>
            <ul class="menu-list">
                <li v-for="item in creatures" :key="item.card.name">
                    <a @click="showCardModal(item.card)">
                        <span class="tag">{{ item.qty }}</span>
                        {{ item.card.name }}
                    </a>
                </li>
            </ul>
        </template>
        <!-- Sorceries -->
        <template v-if="sorceries.length">
            <p class="menu-label">
                Sorceries
            </p>
            <ul class="menu-list">
                <li v-for="item in sorceries" :key="item.card.name">
                    <a @click="showCardModal(item.card)">
                        <span class="tag">{{ item.qty }}</span>
                        {{ item.card.name }}
                    </a>
                </li>
            </ul>
        </template>
        <!-- Instants -->
        <template v-if="instants.length">
            <p class="menu-label">
                Instants
            </p>
            <ul class="menu-list">
                <li v-for="item in instants" :key="item.card.name">
                    <a @click="showCardModal(item.card)">
                        <span class="tag">{{ item.qty }}</span>
                        {{ item.card.name }}
                    </a>
                </li>
            </ul>
        </template>
        <!-- Enchantments -->
        <template v-if="enchantments.length">
            <p class="menu-label">
                Enchantments
            </p>
            <ul class="menu-list">
                <li v-for="item in enchantments" :key="item.card.name">
                    <a @click="showCardModal(item.card)">
                        <span class="tag">{{ item.qty }}</span>
                        {{ item.card.name }}
                    </a>
                </li>
            </ul>
        </template>
        <!-- Artifacts -->
        <template v-if="artifacts.length">
            <p class="menu-label">
                Artifacts
            </p>
            <ul class="menu-list">
                <li v-for="item in artifacts" :key="item.card.name">
                    <a @click="showCardModal(item.card)">
                        <span class="tag">{{ item.qty }}</span>
                        {{ item.card.name }}
                    </a>
                </li>
            </ul>
        </template>
        <!-- Planeswalker -->
        <template v-if="planeswalker.length">
            <p class="menu-label">
                Planeswalker
            </p>
            <ul class="menu-list">
                <li v-for="item in planeswalker" :key="item.card.name">
                    <a @click="showCardModal(item.card)">
                        <span class="tag">{{ item.qty }}</span>
                        {{ item.card.name }}
                    </a>
                </li>
            </ul>
        </template>
        <!-- Lands -->
        <template v-if="lands.length">
            <p class="menu-label">
                Lands
            </p>
            <ul class="menu-list">
                <li v-for="item in lands" :key="item.card.name">
                    <a @click="showCardModal(item.card)">
                        <span class="tag">{{ item.qty }}</span>
                        {{ item.card.name }}
                    </a>
                </li>
            </ul>
        </template>
        <!-- Basic Lands -->
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
    </aside>
</template>

<script>
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
        }
    }
};
</script>
