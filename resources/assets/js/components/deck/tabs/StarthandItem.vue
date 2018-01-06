<template>
    <div :class="columnClass">
        <div class="cardContainer" @click="showCardModal">
            <img class="cardImg" :src="card.card.imageUrl" :alt="card.card.name">
        </div>
    </div>
</template>

<script>
export default {
    props   : [ 'card', 'index' ],
    methods : {
        showCardModal() {
            const card = this.card.card;
            this.$store.dispatch( {
                type    : 'showCardModal',
                card    : card
            } );
        }
    },
    computed : {
        columnClass() {
            let className = 'column is-2';

            if ( this.index === 0 ) {
                className = `${className} is-offset-2`;
            }

            if ( this.index === 4 ) {
                className = `${className} is-offset-3`;
            }

            return className;
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
        transition: .4s all ease;
        box-shadow: 0;
        transform: translateY(0);

        &:before {
            display: block;
            content: "";
            width: 100%;
            padding-top: 139.6025%;
        }

        &:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,.4);
        }
    }

    .cardImg {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
</style>


