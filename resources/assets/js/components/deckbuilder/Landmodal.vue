<template>
    <div class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Add Basic Lands</p>
                <button class="delete" @click="closeModal"></button>
            </header>
            <section class="modal-card-body">
                Basic lands
            </section>
            <footer class="modal-card-foot">
                <a class="button is-success" @click="closeModal">Save changes</a>
                <a class="button" @click="closeModal">Cancel</a>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        methods : {
            closeModal() {
                this.$emit( 'close' );
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