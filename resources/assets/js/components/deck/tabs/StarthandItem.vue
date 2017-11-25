<template>
    <div>
        {{card.card.name}}
    </div>
</template>

<script>
export default {
    props   : [ 'card' ],
    methods : {
        showCardModal() {
            const card = this.card.card;
            this.$store.dispatch( {
                type    : 'showCardModal',
                card    : card
            } );
        }
    }
};
</script>

