<template>
    <div>
        <p class="menu-label">
            {{headline}}
        </p>
        <ul class="menu-list">
            <li v-for="item in cards" :key="item.card.name">
                <!-- <v-popover offset="16" trigger="hover" placement="right"> -->
                    <a @click="showCardModal(item.card)">
                        <span class="tag">{{ item.qty }}</span>
                        {{ item.card.name }}
                    </a>
                    <!-- <template slot="popover">
                        <img :src="item.card.imageUrl" :alt="item.card.name">
                    </template> -->
                <!-- </v-popover> -->
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: [ 'headline', 'cards' ],
    methods : {
        showCardModal( card ) {
            this.$store.dispatch( {
                type    : 'showCardModal',
                card    : card
            } );
        }
    }
}
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
