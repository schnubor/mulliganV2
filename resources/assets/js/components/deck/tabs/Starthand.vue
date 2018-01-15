<template>
    <div>
        <div class="columns has-text-centered">
            <div class="column has-text-centered">
                <button class="button" @click="redraw()">
                    <span class="icon">
                        <i class="fa fa-refresh"></i>
                    </span>
                    <span>Redraw</span>
                </button>
            </div>
        </div>
        <div class="columns is-multiline">
            <StarthandItem v-for="(card, index) in starthand" :card="card" :index="index" :key="card.id + '-' + index"></StarthandItem>
        </div>
    </div>
</template>


<script>
import StarthandItem from './StarthandItem.vue';

export default {
    components : {
        StarthandItem
    },
    data() {
        return {
            starthand : []
        }
    },
    methods : {
        redraw() {
            const allCards = this.$store.getters.deckAllCards;

            // shuffle cards
            allCards.sort( function() {
                return 0.5 - Math.random();
            } );

            const randomCards = allCards.slice( 0, 7 );

            this.starthand = randomCards;
        }
    },
    mounted() {
        this.redraw();
    }
};
</script>

