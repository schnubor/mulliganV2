<template>
    <li>
        <a @click="showSubmenu = !showSubmenu">
            <span class="tag" :class="[fullClass, errorClass]">{{ entry.qty }}</span>
            {{ entry.card.name }}
        </a>
        <ul v-show="showSubmenu">
            <li>
                <a :href="cardUrl" target="_blank">Card Details</a>
            </li>
            <li>
                <a @click="removeCard">Remove one card</a>
            </li>
            <li>
                <a @click="removeEntry">Remove all cards</a>
            </li>
        </ul>
    </li>
</template>

<script>
    import Store from './store.js';
    import _ from 'lodash';
    import slug from 'slug';

    export default {
        props : [ 'entry', 'list' ],
        data() {
            return {
                showSubmenu : false,
                shared      : Store
            };
        },
        computed : {
            fullClass() {
                if ( this.entry.qty === 4 &&
                     _.get( this.entry.card, 'supertypes[0]' ) !== 'Basic' ) {
                    return 'is-warning';
                }
                return '';
            },
            cardUrl() {
                return '/card/' + slug( this.entry.card.name ) + '-' + this.entry.card.multiverseid;
            },
            errorClass() {
                if ( this.entry.qty > 4 &&
                     _.get( this.entry.card, 'supertypes[0]' ) !== 'Basic' ) {
                    return 'is-danger';
                }
                return '';
            }
        },
        methods : {
            removeCard() {
                const index = _.findIndex( this.shared.decklist[ this.list ], { id : this.entry.id } );

                if ( this.shared.decklist[ this.list ][index].qty > 1 ) {
                    this.shared.decklist[ this.list ][index].qty--;
                }
                else {
                    this.shared.decklist[ this.list ][index].qty--;
                    _.remove( this.shared.decklist[ this.list ], { id : this.entry.id } );
                    this.$emit( 'update' );
                }
            },
            removeEntry() {
                const index = _.findIndex( this.shared.decklist[ this.list ], { id : this.entry.id } );

                this.shared.decklist[ this.list ][index].qty = 0;
                _.remove( this.shared.decklist[ this.list ], { id : this.entry.id } );
                this.$emit( 'update' );
            }
        }
    };
</script>
