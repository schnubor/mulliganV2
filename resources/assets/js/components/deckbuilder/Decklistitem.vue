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
    import _ from 'lodash';
    import slug from 'slug';

    export default {
        props : [ 'entry', 'list' ],
        data() {
            return {
                showSubmenu : false
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
                const list = this.list;
                const id = this.entry.id;

                this.$store.dispatch( {
                    type : 'removeCard',
                    list : list,
                    id   : id
                } );
            },
            removeEntry() {
                const list = this.list;
                const id = this.entry.id;

                this.$store.dispatch( {
                    type : 'removeEntry',
                    list : list,
                    id   : id
                } );

                this.showSubmenu = false;
            }
        }
    };
</script>
