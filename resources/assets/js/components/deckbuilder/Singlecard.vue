<template>
    <div :key="card.id" class="card-container" @mouseover="isMouseover = true" @mouseleave="isMouseover = false">
        <div class="singlecard" :class="rarity">
            <div class="cardcontent">
                <img :src="card.imageUrl" :alt="card.name" class="cardimage">
                <div class="is-overlay overlay has-text-centered" :class="{ active : isMouseover }">
                    <a class="button is-primary is-medium" @click="addToDecklist( card )">
                        <span class="icon">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span>Add</span>
                    </a>
                    <div class="details">
                        <a @click="showCardModal" class="is-light" target="_blank">
                            <span class="icon">
                                <i class="fa fa-eye"></i>
                            </span>
                            Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import slug from 'slug';

    export default {
        props : [ 'card' ],
        data() {
            return {
                isMouseover : false
            };
        },
        computed : {
            cardTitle() {
                return slug( this.card.name );
            },
            rarity() {
                switch ( this.card.rarity ) {
                    case 'Mythic Rare' : return 'mythic';
                    case 'Rare' : return 'rare';
                    case 'Uncommon' : return 'uncommon';
                    default : return 'common';
                }
            }
        },
        methods : {
            showCardModal() {
                const card = this.card;
                this.$store.dispatch( {
                    type    : 'showCardModal',
                    card    : card
                } );
            },
            addToDecklist( card ) {
                this.$store.dispatch( {
                    type : 'addToDecklist',
                    card : card
                } );
            }
        }
    };
</script>

<style scoped lang="scss">
    @import "./../../../sass/variables";

    .overlay {
        background-color: rgba(0,0,0,.6);
        border-radius: 10px;
        height: 100%;
        transition: .2s all;
        opacity: 0;

        &.active {
            opacity: 1;
        }

        .button {
            margin-top: 60%;
        }

        .details {
            position: absolute;
            bottom: 10px;
            left: 10px;

            a{
                color: white;
                transition: .2s all;
                opacity: .8;

                &:hover {
                    color: white;
                    opacity: 1;
                }
            }
        }
    }

    .card-container {
        position: relative;
    }

    .singlecard {
        width: 100%;
        overflow: hidden;
        border-radius: 10px;

        .cardimage {
            width: 100%;
        }

        &:before {
            display: block;
            content: "";
            width: 100%;
            padding-top: 139.6825%;
        }

        & > .cardcontent {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
    }

    .common { background-color: $common; }
    .uncommon { background-color: $uncommon; }
    .rare { background-color: $rare; }
    .mythic { background-color: $mythic; }
</style>
