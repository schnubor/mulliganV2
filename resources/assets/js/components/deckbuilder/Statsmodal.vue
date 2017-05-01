<template>
    <div class="modal" :class="{ 'is-active' : isVisible }">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Deck Statistics</p>
                <button class="delete" @click="closeModal"></button>
            </header>
            <section class="modal-card-body">
                <p class="title is-4">Mana Curve</p>
                <Manacurve v-if="isVisible"></Manacurve>
                <hr />
                <div class="columns">
                    <div class="column is-5">
                        <p class="title is-4">Card Types</p>
                        <Cardtypes v-if="isVisible"></Cardtypes>
                    </div>
                    <div class="column is-5 is-offset-2">
                        <p class="title is-4">Mana Distribution</p>
                        <Manadistribution v-if="isVisible"></Manadistribution>
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
    import Manacurve from './../charts/Manacurve.vue';
    import Manadistribution from './../charts/Manadistribution.vue';
    import Cardtypes from './../charts/Cardtypes.vue';

    export default {
        components : {
            Manacurve,
            Manadistribution,
            Cardtypes
        },
        computed : {
            isVisible() {
                return this.$store.getters.statsModal.visible;
            }
        },
        methods  : {
            closeModal() {
                this.$store.dispatch( {
                    type : 'hideStatsModal'
                } );
            }
        }
    };
</script>

<style lang="scss">
    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>
