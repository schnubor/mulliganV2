<template>
    <div class="column is-one-quarter">
        <div class="cardContainer" @click="showCardModal">
            <img class="cardImg" :src="entry.card.imageUrl" :alt="entry.card.name">
            <span class="tag is-black is-medium cardQty"><b>{{ entry.qty }}x</b></span>
        </div>
    </div>
</template>

<script>
export default {
    props   : [ 'entry' ],
    methods : {
        showCardModal() {
            const card = this.entry.card;
            this.$store.dispatch( {
                type    : 'showCardModal',
                card    : card
            } );
        }
    }
};
</script>

<style lang="scss">
.cardContainer {
    cursor: pointer;
}

.cardImg {
    width: 100%;
}

.cardQty {
    position: absolute;
    left: 0;
    bottom: .5rem;
}
</style>
