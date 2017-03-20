<template>
    <div :key="card.id">
        <img :src="card.imageUrl" :alt="card.name" class="card">
    </div>
</template>

<script>
    export default {
        props : [ 'card' ]
    };
</script>
