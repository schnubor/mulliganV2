<template>
    <div class="columns">
        <div class="column is-half">
            <p class="title">Mana Curve</p>
            <Manacurve :decklist="decklist"></Manacurve>
        </div>
        <div class="column is-one-third">
            <p class="title">Card Types</p>
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

