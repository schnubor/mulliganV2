<template>
    <div class="columns">
        <div class="column is-half">
            <Manacurve :decklist="decklist"></Manacurve>
        </div>
        <div class="column is-one-quarter">
            <Cardtypes :chartdata="cardTypeData"></Cardtypes>
        </div>
    </div>
</template>

<script>
import Cardtypes from './../../charts/Cardtypes.vue';
import Manacurve from './../../charts/Manacurve.vue';

export default {
    components : {
        Manacurve,
        Cardtypes
    },
    computed : {
        decklist() {
            return this.$store.getters.deckDecklist;
        },
        cardTypeData() {
            return [
                this.$store.getters.deckCreatureCount,
                this.$store.getters.deckInstantCount,
                this.$store.getters.deckSorceryCount,
                this.$store.getters.deckEnchantmentCount,
                this.$store.getters.deckPlaneswalkerCount,
                this.$store.getters.deckArtifactCount,
                this.$store.getters.deckLandCount,
                this.$store.getters.deckBasiclandCount
            ];
        },
    }
};
</script>

