<template>
    <div class="modal" :class="{ 'is-active' : saveModal.visible }">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">{{ modalTitle }}</p>
                <button class="delete" @click="closeModal"></button>
            </header>
            <section class="modal-card-body">
                <!-- Error Message -->
                <div class="notification is-danger" v-if="saveModal.error">
                    Something went wrong while saving the Deck. Please try again.
                </div>
                <!-- Success Message -->
                <template v-if="saveModal.saved">
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
                            <input class="input is-medium" type="text" readonly="readonly" v-model="saveModal.decklink" onclick="this.select()">
                        </p>
                        <p class="control">
                            <a class="button is-medium is-primary" :href="saveModal.decklink">
                                View
                            </a>
                        </p>
                    </div>
                </template>
                <!--Save Form -->
                <template v-if="!saveModal.saved">
                    <div class="field">
                        <p class="control">
                            <input class="input" @input="updateTitle" type="text" placeholder="Name (required, 140 chars)" :value="title" required>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <textarea class="textarea" @input="updateDescription" placeholder="Description (optional)" :value="description"></textarea>
                        </p>
                    </div>
                    <div class="field is-narrow">
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select required @change="updateFormat">
                                    <option value="">Choose a format (required)</option>
                                    <option v-for="format in saveModal.formats"
                                            :key="format"
                                            :value="format"
                                            :selected="format === deckFormat ? 'selected' : ''">{{ format }}</option>
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
                                <input type="checkbox" @change="updateWip" :checked="wip"> Work in Progress
                            </label>
                        </p>
                    </div>
                </template>
            </section>
            <footer class="modal-card-foot">
                <a class="button is-primary" @click="closeModal" v-if="saveModal.saved">Close</a>
                <a class="button is-primary" :class="{ 'is-loading' : saveModal.saving }" @click="save" v-if="!saveModal.saved" :disabled="!isValid">
                    {{ buttonText }}
                </a>
                <a class="button" @click="closeModal" v-if="!saveModal.saved">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tag : ''
        };
    },
    computed : {
        isValid() {
            if ( this.title.length > 1 && this.title.length <= 140 && this.format !== '' ) {
                return true;
            }
            return false;
        },
        deckId() {
            return this.$store.getters.deckId;  
        },
        saveModal() {
            return this.$store.getters.saveModal;
        },
        cardCount() {
            return this.$store.getters.totalCards.main;
        },
        title() {
            return this.$store.getters.saveModalForm.title;
        },
        description() {
            return this.$store.getters.saveModalForm.description;
        },
        deckFormat() {
            return this.$store.getters.saveModalForm.format;
        },
        tags() {
            return this.$store.getters.saveModalForm.tags;
        },
        wip() {
            return this.$store.getters.saveModalForm.wip;
        },
        modalTitle() {
            return this.deckId ? 'Update Deck' : 'Save Deck';
        },
        buttonText() {
            return this.deckId ? 'Update' : 'Save';
        }
    },
    mounted() {
        this.$store.dispatch( {
            type : 'fetchFormats'
        } );
    },
    methods : {
        updateTitle( e ) {
            this.$store.dispatch( {
                type    : 'updateSaveModalTitle',
                title   : e.target.value
            } )
        },
        updateDescription( e ) {
            this.$store.dispatch( {
                type        : 'updateSaveModalDescription',
                description : e.target.value
            } )
        },
        updateFormat( e ) {
            this.$store.dispatch( {
                type    : 'updateSaveModalFormat',
                format  : e.target.value
            } )
        },
        updateWip( e ) {
            console.log( e.target.checked );
            this.$store.dispatch( {
                type    : 'updateSaveModalWip',
                wip     : e.target.checked
            } )
        },
        addTag() {
            const newTags = this.tags;
            if ( this.tag !== '' ) {
                newTags.push( this.tag );
                this.$store.dispatch( {
                    type : 'updateSaveModalTags',
                    tags : newTags
                } )
            }
            this.tag = '';
        },
        removeTag( index ) {
            const newTags = this.tags;
            newTags.splice( index, 1 );
            this.$store.dispatch( {
                type : 'updateSaveModalTags',
                tags : newTags
            } )
        },
        closeModal() {
            this.$store.dispatch( {
                type : 'hideSaveModal'
            } );
        },
        save() {
            const data = {
                title           : this.title,
                description     : this.description,
                decklist        : JSON.stringify( this.$store.getters.decklist ),
                colors          : JSON.stringify( this.$store.getters.deckcolors ),
                tags            : JSON.stringify( this.tags ),
                format          : this.deckFormat,
                wip             : this.wip,
                cardcount       : this.cardCount,
                ownerId         : null
            };

            if( this.deckId ) {
                this.$store.dispatch( {
                    type : 'updateDeck',
                    data : data
                } );
            } else {
                this.$store.dispatch( {
                    type : 'saveDeck',
                    data : data
                } );
            }
        }
    }
};
</script>

<style lang="scss">
.single-tag {
    margin-right: 5px;
}
</style>
