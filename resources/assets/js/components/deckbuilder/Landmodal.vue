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
                                    @click="mountains--">
                                <span class="icon is-small">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </button>

                            <span class="subtitle has-text-centered">{{ totalMountains }}</span>

                            <button class="button is-small is-pulled-right" @click="mountains++">
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
                                    @click="plains--">
                                <span class="icon is-small">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </button>

                            <span class="subtitle has-text-centered">{{ totalPlains }}</span>

                            <button class="button is-small is-pulled-right" @click="plains++">
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
                                    @click="forests--">
                                <span class="icon is-small">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </button>

                            <span class="subtitle has-text-centered">{{ totalForests }}</span>

                            <button class="button is-small is-pulled-right" @click="forests++">
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
                                    @click="islands--">
                                <span class="icon is-small">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </button>

                            <span class="subtitle has-text-centered">{{ totalIslands }}</span>

                            <button class="button is-small is-pulled-right" @click="islands++">
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
                                    @click="swamps--">
                                <span class="icon is-small">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </button>

                            <span class="subtitle has-text-centered">{{ totalSwamps }}</span>

                            <button class="button is-small is-pulled-right" @click="swamps++">
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
                mountains   : 0,
                plains      : 0,
                forests     : 0,
                islands     : 0,
                swamps      : 0
            };
        },
        computed : {
            totalMountains() {
                return this.$store.getters.basiclands.mountains + this.mountains;
            },
            totalPlains() {
                return this.$store.getters.basiclands.plains + this.plains;
            },
            totalForests() {
                return this.$store.getters.basiclands.forests + this.forests;
            },
            totalIslands() {
                return this.$store.getters.basiclands.islands + this.islands;
            },
            totalSwamps() {
                return this.$store.getters.basiclands.swamps + this.swamps;
            },
            isVisible() {
                return this.$store.getters.landModal.visible;
            }
        },
        methods : {
            reset() {
                this.mountains = 0;
                this.plains = 0;
                this.forests = 0;
                this.islands = 0;
                this.swamps = 0;
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
