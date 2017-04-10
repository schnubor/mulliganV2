<template>
    <div class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Save Deck</p>
                <button class="delete" @click="closeModal"></button>
            </header>
            <section class="modal-card-body">
                Save yo
            </section>
            <footer class="modal-card-foot">
                <a class="button is-primary" @click="save">Save Deck</a>
                <a class="button" @click="closeModal">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>
    import Store from './store.js';

    export default {
        data() {
            return {
                shared      : Store
            };
        },
        computed : {},
        methods  : {
            closeModal() {
                this.$emit( 'closesavemodal' );
            },
            save() {
                // send POST save request ...
                this.$emit( 'closesavemodal' );
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