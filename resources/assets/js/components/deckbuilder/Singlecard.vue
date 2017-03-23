<template>
    <div :key="card.id" class="card-container" @mouseover="isMouseover = true" @mouseleave="isMouseover = false">
        <img :src="card.imageUrl" :alt="card.name" class="card">
        <div class="is-overlay overlay" :class="{ active : isMouseover }"></div>
    </div>
</template>

<script>
    export default {
        props : [ 'card' ],
        data() {
            return {
                isMouseover : false
            };
        }
    };
</script>

<style scoped lang="scss">
    .overlay {
        background-color: rgba(0,0,0,.6);
        border-radius: 14px;
        transition: .2s all;
        opacity: 0;

        &.active {
            opacity: 1;
        }
    }

    .card-container {
        position: relative;
    }
</style>
