<template>
    <div class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Save Deck</p>
                <button class="delete" @click="closeModal"></button>
            </header>
            <section class="modal-card-body">
                <div class="notification is-danger" v-if="error">
                    Something went wrong while saving the Deck. Please try again.
                </div>

                <template v-if="saved">
                    <div class="notification is-success">
                        Success! The Deck has been sleeved, sorted and stored successfully and can be viewed using the link below.
                    </div>
                    <div class="field has-addons">
                        <p class="control">
                            <a class="button is-medium is-disabled">
                                <span class="icon">
                                    <i class="fa fa-link"></i>
                                </span>
                            </a>
                        </p>
                        <p class="control is-expanded">
                            <input class="input is-medium" type="text" readonly="readonly" v-model="decklink" onclick="this.select()">
                        </p>
                    </div>
                </template>
                <template v-if="!saved">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="text" placeholder="Name (required, 140 chars)" v-model="title">
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <textarea class="textarea" placeholder="Description (optional)" v-model="description"></textarea>
                        </p>
                    </div>
                </template>
            </section>
            <footer class="modal-card-foot">
                <a class="button is-primary" @click="closeModal" v-if="saved">Close</a>
                <a class="button is-primary" :class="{ 'is-loading' : saving, 'is-disabled' : !isValid }" @click="save" v-if="!saved">Save Deck</a>
                <a class="button" @click="closeModal" v-if="!saved">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>
    import Store from './store.js';
    import axios from 'axios';

    export default {
        data() {
            return {
                shared      : Store,
                title       : '',
                description : '',
                decklink    : '',
                saving      : false,
                saved       : false,
                error       : false
            };
        },
        computed : {
            isValid() {
                if ( this.title.length > 1 && this.title.length <= 140 ) {
                    return true;
                }
                return false;
            }
        },
        methods  : {
            closeModal() {
                this.reset();
                this.$emit( 'closesavemodal' );
            },
            reset() {
                this.saved = false;
                this.error = false;
                this.saving = false;
                this.title = '';
                this.description = '';
            },
            save() {
                this.saved = false;
                this.error = false;
                this.saving = true;

                const self = this;
                const data = {
                    title       : this.title,
                    description : this.description,
                    decklist    : JSON.stringify( this.shared.decklist ),
                    ownerId     : 1
                };

                axios.post( '/api/decks', data )
                .then( function( response ) {
                    self.saving = false;
                    self.saved = true;
                    self.error = false;
                    self.decklink = 'https://mulligan.com/decks/' + response.data.deckname;
                    console.log( response );
                } )
                .catch( function( error ) {
                    console.warn( error );
                    self.saving = false;
                    self.saved = false;
                    self.error = true;
                } );
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