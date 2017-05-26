<template>
    <div class="column is-one-quarter">
        <div class="cardContainer">
            <img class="cardImg" :src="entry.card.imageUrl" :alt="entry.card.name">
            <span class="tag is-black cardQty">{{ entry.qty }}x</span>
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
    left: 1rem;
    bottom: 1rem;
}
</style>
