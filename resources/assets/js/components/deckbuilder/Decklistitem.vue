<template>
    <li>
        <v-popover offset="16" trigger="hover" placement="right"> 
            <a @click="showSubmenu = !showSubmenu">
                <span class="tag" :class="[fullClass, errorClass]">{{ entry.qty }}</span>
                {{ entry.card.name }}
            </a>
            <template slot="popover">
                <img :src="entry.card.imageUrl" :alt="entry.card.name">
            </template>
        </v-popover>
        <ul v-show="showSubmenu">
            <li>
                <a :href="cardUrl" target="_blank">
                    <i class="fa fa-fw fa-link"></i> Card Details
                </a>
            </li>
            <li>
                <a @click="removeCard"><i class="fa fa-fw fa-minus"></i> Remove one</a>
            </li>
            <li>
                <a @click="removeEntry"><i class="fa fa-fw fa-trash-o"></i> Remove all</a>
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
                return '/cards/' + slug( this.entry.card.name ) + '-' + this.entry.card.multiverseid;
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

<style lang="scss">
    .v-popover {
        .trigger {
            display: inline !important;
        }
    }

    .tooltip {
        &.popover {
            $color: whitesmoke;

            .popover-inner {
                background: $color;
                color: black;
                padding: 24px;
                border-radius: 5px;
                box-shadow: 0 5px 30px rgba(black, .1);
            }

            .popover-arrow {
                border-color: $color;
            }
        }
    }

    .tooltip-arrow {
        z-index: 1;
    }
</style>
