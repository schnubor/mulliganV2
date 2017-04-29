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
                <a @click="showCardModal" class="is-light" target="_blank">
                    <span class="icon">
                        <i class="fa fa-eye"></i>
                    </span>
                    Details
                </a>
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
