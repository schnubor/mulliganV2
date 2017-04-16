<template>
    <div class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">
                    MultiverseID <span class="multiverseid">#{{ shared.cardModal.multiverseid }}</span>
                </p>
                <button class="delete" @click="closeModal"></button>
            </header>
            <section class="modal-card-body">
                <p class="title">
                    <a :href="cardUrl" target="_blank">{{ shared.cardModal.name }}</a>
                </p>
                <p class="subtitle">{{ shared.cardModal.type }}</p>
                <hr>
                <div class="columns">
                    <div class="column is-one-third">
                        <img :src="shared.cardModal.imageUrl" :alt="shared.cardModal.name">
                        <p>
                            <small class="has-text-left">Artist: {{ shared.cardModal.artist }}</small>
                        </p>
                    </div>
                    <div class="column content">
                        <p v-if="shared.cardModal.manaCost" v-html="manaCosts"></p>
                        <hr>
                        <p v-if="shared.cardModal.text" v-html="rawText"></p>
                        <blockquote v-if="shared.cardModal.flavor">
                            <em>{{ shared.cardModal.flavor }}</em>
                        </blockquote>
                        <p v-if="shared.cardModal.power">
                            <span class="title" style="padding-right: 10px;">
                                <span class="icon is-medium">
                                    <i class="fa fa-gavel"></i>
                                </span>
                                <strong>{{ shared.cardModal.power }}</strong>
                            </span>

                            <span class="title">
                                <span class="icon is-medium">
                                    <i class="fa fa-shield"></i>
                                </span>
                                <strong>{{ shared.cardModal.toughness }}</strong>
                            </span>
                        </p>
                        <hr>
                        <p>
                            Set: {{ shared.cardModal.setName }} ({{ shared.cardModal.set }})
                        </p>
                        <hr>
                        <template v-if="shared.cardModal.legalities">
                            <p class="title is-4">Legalities</p>
                            <template v-for="legality in shared.cardModal.legalities">
                                <span class="tag legality" :class="{ 
                                    'is-success' : legality.legality === 'Legal',
                                    'is-warning' : legality.legality === 'Restricted',
                                    'is-danger' : legality.legality === 'Banned'
                                }">
                                    {{ legality.format }}
                                </span>
                            </template>
                            <hr>
                        </template>
                        <template v-if="shared.cardModal.rulings">
                            <p class="title is-4">Rulings</p>
                            <template v-for="ruling in shared.cardModal.rulings">
                                <div class="box">
                                    <div class="content">
                                        <p>
                                            {{ ruling.text }}
                                        </p>
                                        <small>– {{ ruling.date }}</small>
                                    </div>
                                </div>
                            </template>
                        </template>
                    </div>
                </div>

            </section>
            <footer class="modal-card-foot">
                <a class="button is-primary" @click="closeModal">Close</a>
            </footer>
        </div>
    </div>
</template>

<script>
    import Store from './store.js';
    import { replaceManaCosts, replaceManaText } from './../../utils.js';
    import slug from 'slug';

    export default {
        data() {
            return {
                shared : Store
            };
        },
        computed : {
            rawText() {
                return replaceManaText( this.shared.cardModal.text );
            },
            cardUrl() {
                if ( this.shared.cardModal.name ) {
                    return window.location.protocol + '//' + window.location.host + '/card/' + slug( this.shared.cardModal.name ) + '-' + this.shared.cardModal.multiverseid;
                }
                return '';
            },
            manaCosts() {
                return replaceManaCosts( this.shared.cardModal.manaCost );
            }
        },
        methods  : {
            closeModal() {
                this.$emit( 'closecardmodal' );
            }
        }
    };
</script>

<style lang="scss" scoped>
    .multiverseid {
        opacity: .5;
    }

    .tag.legality {
        margin: 5px 10px 5px 0;
    }
</style>