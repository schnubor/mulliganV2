<template>
    <div :key="card.id" class="card-container" @mouseover="isMouseover = true" @mouseleave="isMouseover = false">
        <img :src="card.imageUrl" :alt="card.name" class="card">
        <div class="is-overlay overlay has-text-centered" :class="{ active : isMouseover }">
            <a class="button is-primary is-medium" @click="addToDecklist( card )">
                <span class="icon">
                    <i class="fa fa-plus"></i>
                </span>
                <span>Add</span>
            </a>
            <div class="details">
                <a :href="'/card/' + cardTitle + '-' + card.multiverseid" class="is-light" target="_blank">
                    <span class="icon">
                        <i class="fa fa-eye"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    import slug from 'slug';
    import _ from 'lodash';
    import Store from './store.js';

    export default {
        props : [ 'card' ],
        data() {
            return {
                shared      : Store,
                isMouseover : false
            };
        },
        computed : {
            cardTitle() {
                return slug( this.card.name );
            }
        },
        methods : {
            updateDecklist( list, card ) {
                const existingCardIndex = _.findIndex( list, { 'id' : card.id } );

                if ( existingCardIndex > -1 ) {
                    list[ existingCardIndex ].qty++;
                }
                else {
                    const newCard = {
                        'id'   : card.id,
                        'card' : card,
                        'qty'  : 1
                    };
                    list.push( newCard );
                }
            },
            addToDecklist( card ) {
                switch ( card.types[ 0 ] ) {
                    case 'Creature' :
                        this.updateDecklist( this.shared.decklist.creatures, card );
                        break;
                    case 'Instant' :
                        this.updateDecklist( this.shared.decklist.instants, card );
                        break;
                    case 'Sorcery' :
                        this.updateDecklist( this.shared.decklist.sorceries, card );
                        break;
                    case 'Land' :
                        this.updateDecklist( this.shared.decklist.lands, card );
                        break;
                    case 'Artifact' :
                        this.updateDecklist( this.shared.decklist.artifacts, card );
                        break;
                    case 'Enchantment' :
                        this.updateDecklist( this.shared.decklist.enchantments, card );
                        break;
                    case 'Planeswalker' :
                        this.updateDecklist( this.shared.decklist.planeswalker, card );
                        break;
                    default: break;
                }
            }
        }
    };
</script>

<style scoped lang="scss">
    .overlay {
        background-color: rgba(0,0,0,.6);
        border-radius: 14px;
        height: 98%;
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

    .card {
        width: 100%;
    }
</style>
