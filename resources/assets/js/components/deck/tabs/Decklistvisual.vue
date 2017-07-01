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
@import "./../../../../sass/variables";

.cardContainer {
    cursor: pointer;
    background-color: $lightgrey;
    overflow: hidden;
    position: relative;
    width: 100%;
    border-radius: 10px;

    &:before {
        display: block;
        content: "";
        width: 100%;
        padding-top: 139.6825%;
    }
}

.cardImg {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
}

.cardQty {
    position: absolute;
    left: 0;
    bottom: .5rem;
}
</style>
