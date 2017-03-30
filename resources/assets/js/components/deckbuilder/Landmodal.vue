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
                        
                        <p class="title has-text-centered is-marginless">10</p>
                        <div class="actions has-text-centered">
                            <a class="button">
                                <span class="icon is-small">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </a>
                            <a class="button">
                                <span class="icon is-small">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="column">
                        <img src="http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid=401992&type=card" alt="Plain" width="100%">
                        
                        <p class="title has-text-centered is-marginless">10</p>
                        <div class="actions has-text-centered">
                            <a class="button">
                                <span class="icon is-small">
                                    <i class="fa fa-minus"></i>
                                </span>
                            </a>
                            <a class="button">
                                <span class="icon is-small">
                                    <i class="fa fa-plus"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="column">
                        <img src="http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid=401890&type=card" alt="Forest" width="100%">
                        <p class="title has-text-centered">10</p>
                    </div>
                    <div class="column">
                        <img src="http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid=401925&type=card" alt="Island" width="100%">
                        <p class="title has-text-centered">10</p>
                    </div>
                    <div class="column">
                        <img src="http://gatherer.wizards.com/Handlers/Image.ashx?multiverseid=402060&type=card" alt="Swamp" width="100%">
                        <p class="title has-text-centered">10</p>
                    </div>
                </div>
            </section>
            <footer class="modal-card-foot">
                <a class="button is-success" @click="closeModal">Save changes</a>
                <a class="button" @click="closeModal">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        methods : {
            closeModal() {
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