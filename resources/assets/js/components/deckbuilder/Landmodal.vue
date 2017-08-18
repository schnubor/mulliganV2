<template>
    <div class="modal" :class="{ 'is-active' : isVisible }">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Add Basic Lands</p>
                <button class="delete" @click="closeModal"></button>
            </header>
            <section class="modal-card-body">
                <div class="columns">
                    <div class="column">
                        <div class="manaIcon has-text-centered">
                            <i class="ms ms-r ms-4x ms-cost"></i>
                        </div>
                        <div class="actions has-text-centered">
                            <button class="button is-small is-pulled-left"
                                    :disabled="totalMountains === 0"
                                    @click="decrease( 'mountains' )">
                                <span class="icon is-small">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </button>

                            <span class="subtitle has-text-centered">{{ totalMountains }}</span>

                            <button class="button is-small is-pulled-right" @click="increase( 'mountains' )">
                                <span class="icon is-small">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="column">
                        <div class="manaIcon has-text-centered">
                            <i class="ms ms-w ms-4x ms-cost"></i>
                        </div>

                        <div class="actions has-text-centered">
                            <button class="button is-small is-pulled-left"
                                    :disabled="totalPlains === 0"
                                    @click="decrease( 'plains' )">
                                <span class="icon is-small">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </button>

                            <span class="subtitle has-text-centered">{{ totalPlains }}</span>

                            <button class="button is-small is-pulled-right" @click="increase( 'plains' )">
                                <span class="icon is-small">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </button>
                        </div>
                        
                    </div>
                    <div class="column">
                        <div class="manaIcon has-text-centered">
                            <i class="ms ms-g ms-4x ms-cost"></i>
                        </div>
                        
                        <div class="actions has-text-centered">
                            <button class="button is-small is-pulled-left"
                                    :disabled="totalForests === 0"
                                    @click="decrease( 'forests' )">
                                <span class="icon is-small">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </button>

                            <span class="subtitle has-text-centered">{{ totalForests }}</span>

                            <button class="button is-small is-pulled-right" @click="increase( 'forests' )">
                                <span class="icon is-small">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="column">
                        <div class="manaIcon has-text-centered">
                            <i class="ms ms-u ms-4x ms-cost"></i>
                        </div>
                        
                        <div class="actions has-text-centered">
                            <button class="button is-small is-pulled-left"
                                    :disabled="totalIslands === 0"
                                    @click="decrease( 'islands' )">
                                <span class="icon is-small">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </button>

                            <span class="subtitle has-text-centered">{{ totalIslands }}</span>

                            <button class="button is-small is-pulled-right" @click="increase( 'islands' )">
                                <span class="icon is-small">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="column">
                        <div class="manaIcon has-text-centered">
                            <i class="ms ms-b ms-4x ms-cost"></i>
                        </div>
                        
                        <div class="actions has-text-centered">
                            <button class="button is-small is-pulled-left"
                                    :disabled="totalSwamps === 0"
                                    @click="decrease( 'swamps' )">
                                <span class="icon is-small">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </button>

                            <span class="subtitle has-text-centered">{{ totalSwamps }}</span>

                            <button class="button is-small is-pulled-right" @click="increase( 'swamps' )">
                                <span class="icon is-small">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <footer class="modal-card-foot">
                <a class="button is-primary" @click="save">Save & Close</a>
                <a class="button" @click="closeModal">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                main : {
                    mountains   : 0,
                    plains      : 0,
                    forests     : 0,
                    islands     : 0,
                    swamps      : 0
                },
                sideboard : {
                    mountains   : 0,
                    plains      : 0,
                    forests     : 0,
                    islands     : 0,
                    swamps      : 0
                }
            };
        },
        computed : {
            activeList() {
                return this.$store.getters.activeList;
            },
            totalMountains() {
                const basiclands = this.$store.getters.basiclands;

                if ( this.activeList === 'sideboard' ) {
                    return basiclands.sideboard.mountains + this.sideboard.mountains;
                }
                return basiclands.main.mountains + this.main.mountains;
            },
            totalPlains() {
                const basiclands = this.$store.getters.basiclands;

                if ( this.activeList === 'sideboard' ) {
                    return basiclands.sideboard.plains + this.sideboard.plains;
                }
                return basiclands.main.plains + this.main.plains;
            },
            totalForests() {
                const basiclands = this.$store.getters.basiclands;

                if ( this.activeList === 'sideboard' ) {
                    return basiclands.sideboard.forests + this.sideboard.forests;
                }
                return basiclands.main.forests + this.main.forests;
            },
            totalIslands() {
                const basiclands = this.$store.getters.basiclands;

                if ( this.activeList === 'sideboard' ) {
                    return basiclands.sideboard.islands + this.sideboard.islands;
                }
                return basiclands.main.islands + this.main.islands;
            },
            totalSwamps() {
                const basiclands = this.$store.getters.basiclands;

                if ( this.activeList === 'sideboard' ) {
                    return basiclands.sideboard.swamps + this.sideboard.swamps;
                }
                return basiclands.main.swamps + this.main.swamps;
            },
            isVisible() {
                return this.$store.getters.landModal.visible;
            }
        },
        methods : {
            increase( land ) {
                this[this.activeList][land]++;
            },
            decrease( land ) {
                this[this.activeList][land]--;
            },
            reset() {
                this.main.mountains = 0;
                this.main.plains = 0;
                this.main.forests = 0;
                this.main.islands = 0;
                this.main.swamps = 0;

                this.sideboard.mountains = 0;
                this.sideboard.plains = 0;
                this.sideboard.forests = 0;
                this.sideboard.islands = 0;
                this.sideboard.swamps = 0;
            },
            closeModal() {
                this.reset();
                this.$store.dispatch( {
                    type : 'hideLandModal'
                } );
            },
            save() {
                this.$store.dispatch( {
                    type        : 'updateBasicLands',
                    list        : this.activeList,
                    mountains   : this.totalMountains,
                    plains      : this.totalPlains,
                    forests     : this.totalForests,
                    islands     : this.totalIslands,
                    swamps      : this.totalSwamps
                } );

                this.$store.dispatch( {
                    type : 'hideLandModal'
                } );

                this.reset();
            }
        }
    };
</script>

<style lang="scss">

    .manaIcon {
        padding: 30px 0;
        margin-bottom: 10px;
        border-radius: 4px;
        background-color: whitesmoke;
    }

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>
