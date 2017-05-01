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
                <Manacurve></Manacurve>
            </section>
            <footer class="modal-card-foot">
                <a class="button is-primary" @click="closeModal">Close</a>
            </footer>
        </div>
    </div>
</template>

<script>
    import Manacurve from './../charts/Manacurve.vue';

    export default {
        components : {
            Manacurve
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
