<template>
    <div class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Add Basic Lands</p>
                <button class="delete" @click="closeModal"></button>
            </header>
            <section class="modal-card-body">
                <div class="columns">
                    <div class="column">
                        <img src="http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid=401961&type=card" alt="Mountain" width="100%">

                        <div class="actions has-text-centered">
                            <a class="button is-small is-pulled-left" @click="mountains--">
                                <span class="icon is-small">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </a>

                            <span class="subtitle has-text-centered">{{ totalMountains }}</span>

                            <a class="button is-small is-pulled-right" @click="mountains++">
                                <span class="icon is-small">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="column">
                        <img src="http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid=401992&type=card" alt="Plain" width="100%">

                        <div class="actions has-text-centered">
                            <a class="button is-small is-pulled-left" @click="plains--">
                                <span class="icon is-small">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </a>

                            <span class="subtitle has-text-centered">{{ totalPlains }}</span>

                            <a class="button is-small is-pulled-right" @click="plains++">
                                <span class="icon is-small">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </a>
                        </div>
                        
                    </div>
                    <div class="column">
                        <img src="http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid=401890&type=card" alt="Forest" width="100%">
                        
                        <div class="actions has-text-centered">
                            <a class="button is-small is-pulled-left" @click="forests--">
                                <span class="icon is-small">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </a>

                            <span class="subtitle has-text-centered">{{ totalForests }}</span>

                            <a class="button is-small is-pulled-right" @click="forests++">
                                <span class="icon is-small">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="column">
                        <img src="http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid=401925&type=card" alt="Island" width="100%">
                        
                        <div class="actions has-text-centered">
                            <a class="button is-small is-pulled-left" @click="islands--">
                                <span class="icon is-small">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </a>

                            <span class="subtitle has-text-centered">{{ totalIslands }}</span>

                            <a class="button is-small is-pulled-right" @click="islands++">
                                <span class="icon is-small">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="column">
                        <img src="http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid=402060&type=card" alt="Swamp" width="100%">
                        
                        <div class="actions has-text-centered">
                            <a class="button is-small is-pulled-left" @click="swamps--">
                                <span class="icon is-small">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </a>

                            <span class="subtitle has-text-centered">{{ totalSwamps }}</span>

                            <a class="button is-small is-pulled-right" @click="swamps++">
                                <span class="icon is-small">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <footer class="modal-card-foot">
                <a class="button is-primary" @click="save">Save changes</a>
                <a class="button" @click="closeModal">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>
    import Store from './store.js';

    export default {
        data() {
            return {
                shared      : Store,
                mountains   : 0,
                plains      : 0,
                forests     : 0,
                islands     : 0,
                swamps      : 0
            };
        },
        computed : {
            totalMountains() {
                return this.shared.decklist.basiclands.mountains + this.mountains;
            },
            totalPlains() {
                return this.shared.decklist.basiclands.plains + this.plains;
            },
            totalForests() {
                return this.shared.decklist.basiclands.forests + this.forests;
            },
            totalIslands() {
                return this.shared.decklist.basiclands.islands + this.islands;
            },
            totalSwamps() {
                return this.shared.decklist.basiclands.swamps + this.swamps;
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
                this.$emit( 'closelandmodal' );
            },
            save() {
                this.shared.decklist.basiclands.mountains = this.totalMountains;
                this.shared.decklist.basiclands.plains = this.totalPlains;
                this.shared.decklist.basiclands.forests = this.totalForests;
                this.shared.decklist.basiclands.islands = this.totalIslands;
                this.shared.decklist.basiclands.swamps = this.totalSwamps;
                this.reset();
                this.$emit( 'closelandmodal' );
            }
        }
    };
</script>

<style lang="scss">
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