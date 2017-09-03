<template>
    <div class="modal" :class="{ 'is-active' : isVisible }">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Save Deck</p>
                <button class="delete" @click="closeModal"></button>
            </header>
            <section class="modal-card-body">
                <!-- Error Message -->
                <div class="notification is-danger" v-if="error">
                    Something went wrong while saving the Deck. Please try again.
                </div>
                <!-- Success Message -->
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
                        <p class="control">
                            <a class="button is-medium is-primary" :href="decklink">
                                View
                            </a>
                        </p>
                    </div>
                </template>
                <!--Save Form -->
                <template v-if="!saved">
                    <div class="field">
                        <p class="control">
                            <input class="input" type="text" placeholder="Name (required, 140 chars)" v-model="title" required>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <textarea class="textarea" placeholder="Description (optional)" v-model="description"></textarea>
                        </p>
                    </div>
                    <div class="field is-narrow">
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select v-model="format" required>
                                    <option value="">Choose a format (required)</option>
                                    <option :value="format" v-for="format in formats" :key="format">{{ format }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="field has-addons">
                        <p class="control">
                            <input class="input" type="text" placeholder="Add Tags" v-model="tag" @keyup.enter="addTag">
                        </p>
                        <p class="control">
                            <a class="button is-primary" @click="addTag">
                                Add
                            </a>
                        </p>
                    </div>
                    <div class="field">
                        <span class="tag is-primary single-tag" v-for="tag, index in tags" :key="tag">
                            {{ tag }}
                            <button class="delete is-small" @click="removeTag( index )"></button>
                        </span>
                    </div>
                    <div class="field">
                        <p class="control">
                            <label class="checkbox">
                                <input type="checkbox" v-model="wip"> Work in Progress
                            </label>
                        </p>
                    </div>
                </template>
            </section>
            <footer class="modal-card-foot">
                <a class="button is-primary" @click="closeModal" v-if="saved">Close</a>
                <a class="button is-primary" :class="{ 'is-loading' : saving }" @click="save" v-if="!saved" :disabled="!isValid">Save Deck</a>
                <a class="button" @click="closeModal" v-if="!saved">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            title       : '',
            description : '',
            tag         : '',
            tags        : [],
            format      : '',
            decklink    : '',
            saving      : false,
            saved       : false,
            error       : false
        };
    },
    computed : {
        isValid() {
            if ( this.title.length > 1 && this.title.length <= 140 && this.format !== '' ) {
                return true;
            }
            return false;
        },
        isVisible() {
            return this.$store.getters.saveModal.visible;
        },
        formats() {
            return this.$store.getters.saveModal.formats;
        },
        isLoading() {
            return this.$store.getters.saveModal.loading;
        },
        fetchError() {
            return this.$store.getters.saveModal.error;
        },
        wip() {
            return this.$store.getters.totalCards < 60;
        },
        cardCount() {
            return this.$store.getters.totalCards;
        }
    },
    mounted() {
        this.$store.dispatch( {
            type : 'fetchFormats'
        } );
    },
    methods : {
        addTag() {
            if ( this.tag !== '' ) {
                this.tags.push( this.tag );
            }
            this.tag = '';
        },
        removeTag( index ) {
            this.tags.splice( index, 1 );
        },
        closeModal() {
            if ( this.saved ) {
                this.reset();
            }
            this.$store.dispatch( {
                type : 'hideSaveModal'
            } );
        },
        reset() {
            this.saved = false;
            this.error = false;
            this.saving = false;
            this.title = '';
            this.description = '';
            this.tags = [];
        },
        save() {
            this.saved = false;
            this.error = false;
            this.saving = true;

            const self = this;
            const data = {
                title           : this.title,
                description     : this.description,
                decklist        : JSON.stringify( this.$store.getters.decklist ),
                colors          : JSON.stringify( this.$store.getters.deckcolors ),
                tags            : JSON.stringify( this.tags ),
                format          : this.format,
                wip             : this.wip,
                cardcount       : this.cardCount,
                ownerId         : null
            };

            axios.post( '/api/decks', data )
                .then( function( response ) {
                    self.saving = false;
                    self.saved = true;
                    self.error = false;
                    self.decklink = window.location.protocol + '//' + window.location.host + '/decks/' + response.data.deckname;
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
.single-tag {
    margin-right: 5px;
}
</style>
