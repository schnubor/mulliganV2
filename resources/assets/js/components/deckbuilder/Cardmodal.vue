<template>
    <div class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">{{ shared.cardModal.name }}</p>
                <button class="delete" @click="closeModal"></button>
            </header>
            <section class="modal-card-body">
                dem details
            </section>
            <footer class="modal-card-foot">
                <a class="button is-primary" @click="closeModal">Close</a>
            </footer>
        </div>
    </div>
</template>

<script>
    import Store from './store.js';

    export default {
        data() {
            return {
                shared : Store
            };
        },
        computed : {},
        methods  : {
            closeModal() {
                this.$emit( 'closecardmodal' );
            }
        }
    };
</script>

<style lang="scss">

</style>