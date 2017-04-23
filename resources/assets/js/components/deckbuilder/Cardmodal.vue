<template>
    <div class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">
                    MultiverseID <span class="multiverseid">#{{ this.$store.state.cardModal.multiverseid }}</span>
                </p>
                <button class="delete" @click="closeModal"></button>
            </header>
            <section class="modal-card-body">
                <p class="title">
                    <a :href="cardUrl" target="_blank">{{ this.$store.state.cardModal.name }}</a>
                    <span class="link-icon"><i class="fa fa-link"></i></span>
                </p>
                <p class="subtitle">{{ this.$store.state.cardModal.type }}</p>
                <hr>
                <div class="columns">
                    <div class="column is-one-third">
                        <img :src="this.$store.state.cardModal.imageUrl" :alt="this.$store.state.cardModal.name">
                        <p>
                            <small class="has-text-left">Artist: {{ this.$store.state.cardModal.artist }}</small>
                        </p>
                    </div>
                    <div class="column content">
                        <p v-if="this.$store.state.cardModal.manaCost" v-html="manaCosts"></p>
                        <hr>
                        <p v-if="this.$store.state.cardModal.text" v-html="rawText"></p>
                        <blockquote v-if="this.$store.state.cardModal.flavor">
                            <em>{{ this.$store.state.cardModal.flavor }}</em>
                        </blockquote>
                        <p v-if="this.$store.state.cardModal.power">
                            <span class="title" style="padding-right: 10px;">
                                <span class="icon is-medium">
                                    <i class="fa fa-gavel"></i>
                                </span>
                                <strong>{{ this.$store.state.cardModal.power }}</strong>
                            </span>

                            <span class="title">
                                <span class="icon is-medium">
                                    <i class="fa fa-shield"></i>
                                </span>
                                <strong>{{ this.$store.state.cardModal.toughness }}</strong>
                            </span>
                        </p>
                        <hr>
                        <p>
                            Set: {{ this.$store.state.cardModal.setName }} ({{ this.$store.state.cardModal.set }})
                        </p>
                        <hr>
                        <template v-if="this.$store.state.cardModal.legalities">
                            <p class="title is-4">Legalities</p>
                            <template v-for="legality in this.$store.state.cardModal.legalities">
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
                        <template v-if="this.$store.state.cardModal.rulings">
                            <p class="title is-4">Rulings</p>
                            <template v-for="ruling in this.$store.state.cardModal.rulings">
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
    import { replaceManaCosts, replaceManaText } from './../../utils.js';
    import slug from 'slug';

    export default {
        computed : {
            rawText() {
                return replaceManaText( this.$store.state.cardModal.text );
            },
            cardUrl() {
                if ( this.$store.state.cardModal.name ) {
                    return window.location.protocol + '//' + window.location.host + '/card/' + slug( this.$store.state.cardModal.name ) + '-' + this.$store.state.cardModal.multiverseid;
                }
                return '';
            },
            manaCosts() {
                return replaceManaCosts( this.$store.state.cardModal.manaCost );
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

    .link-icon {
        opacity: .2;
    }
</style>
