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
            $color: #363636;

            .popover-inner {
                border-radius: 10px;
                box-shadow: 0 0px 30px rgba(black, .2);
                font-size: 0;
            }

            .popover-arrow {
                display: none;
            }
        }

        &[x-placement^="left"] {
            margin-right: 5px;

            .tooltip-arrow {
                border-width: 5px 0 5px 5px;
                border-top-color: transparent !important;
                border-right-color: transparent !important;
                border-bottom-color: transparent !important;
                right: -5px;
                top: calc(50% - 5px);
                margin-left: 0;
                margin-right: 0;
            }
        }
    }

    .tooltip-arrow {
        z-index: 1;
    }
</style>
