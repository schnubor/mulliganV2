<template>
    <aside class="menu">
        <!-- Creatures -->
        <template v-if="creatures.length">
            <p class="menu-label">
                Creatures
            </p>
            <ul class="menu-list">
                <li v-for="item in creatures">
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
                <li v-for="item in sorceries">
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
                <li v-for="item in instants">
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
                <li v-for="item in enchantments">
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
                <li v-for="item in artifacts">
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
                <li v-for="item in planeswalker">
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
                <li v-for="item in lands">
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
        },
        basiclands() {
            return this.$store.getters.deckBasiclands;
        }
    }
};
</script>
