<template>
    <div class="modal" :class="{ 'is-active' : isVisible }">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">
                    MultiverseID <span class="multiverseid">#{{ card.multiverseid }}</span>
                </p>
                <button class="delete" @click="closeModal"></button>
            </header>
            <section class="modal-card-body">
                <p class="title">
                    <a :href="cardUrl" target="_blank">{{ card.name }}</a>
                    <span class="link-icon"><i class="fa fa-link"></i></span>
                </p>
                <p class="subtitle">{{ card.type }}</p>
                <hr>
                <div class="columns">
                    <div class="column is-one-third">
                        <img :src="card.imageUrl" :alt="card.name">
                        <p>
                            <small class="has-text-left">Artist: {{ card.artist }}</small>
                        </p>
                    </div>
                    <div class="column is-two-thirds content">
                        <p v-if="card.manaCost" v-html="manaCosts"></p>
                        <hr>
                        <p v-if="card.text" v-html="rawText"></p>
                        <blockquote v-if="card.flavor">
                            <em>{{ card.flavor }}</em>
                        </blockquote>
                        <p v-if="card.power">
                            <span class="title" style="padding-right: 10px;">
                                <span class="icon is-medium">
                                    <i class="fa fa-gavel"></i>
                                </span>
                                <strong>{{ card.power }}</strong>
                            </span>

                            <span class="title">
                                <span class="icon is-medium">
                                    <i class="fa fa-shield"></i>
                                </span>
                                <strong>{{ card.toughness }}</strong>
                            </span>
                        </p>
                        <hr>
                        <p>
                            Set: {{ card.setName }} ({{ card.set }})
                        </p>
                        <hr>
                        <template v-if="card.legalities">
                            <p class="title is-4">Legalities</p>
                            <template v-for="legality in card.legalities">
                                <span class="tag legality" :key="legality.legality" :class="{ 
                                    'is-success' : legality.legality === 'Legal',
                                    'is-warning' : legality.legality === 'Restricted',
                                    'is-danger' : legality.legality === 'Banned'
                                }">
                                    {{ legality.format }}
                                </span>
                            </template>
                            <hr>
                        </template>
                        <template v-if="card.rulings">
                            <p class="title is-4">Rulings</p>
                            <template v-for="ruling in card.rulings">
                                <div class="box" :key="ruling.text">
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
                return replaceManaText( this.card.text );
            },
            cardUrl() {
                if ( this.card.name ) {
                    return window.location.protocol + '//' + window.location.host + '/cards/' + slug( this.card.name ) + '-' + this.card.multiverseid;
                }
                return '';
            },
            manaCosts() {
                return replaceManaCosts( this.card.manaCost );
            },
            card() {
                return this.$store.getters.cardModal.card;
            },
            isVisible() {
                return this.$store.getters.cardModal.visible;
            }
        },
        methods  : {
            closeModal() {
                this.$store.dispatch( {
                    type : 'hideCardModal'
                } );
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
