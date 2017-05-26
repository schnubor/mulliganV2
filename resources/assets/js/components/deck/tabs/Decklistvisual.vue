<template>
    <div class="column is-one-quarter">
        <div class="cardContainer">
            <img class="cardImg" :src="entry.card.imageUrl" :alt="entry.card.name">
            <span class="tag is-black is-medium cardQty"><b>{{ entry.qty }}x</b></span>
        </div>
    </div>
</template>

<script>
export default {
    props : [ 'entry' ]
};
</script>

<style lang="scss">
.cardImg {
    width: 100%;
}

.cardQty {
    position: absolute;
    left: 0;
    bottom: .5rem;
}
</style>
