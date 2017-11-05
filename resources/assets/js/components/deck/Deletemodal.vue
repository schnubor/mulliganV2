<template>
    <div class="modal" :class="{ 'is-active' : isVisible }">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Confirm Delete</p>
                <button class="delete" @click="closeModal"></button>
            </header>
            <section class="modal-card-body">
                <div class="content">
                    <p>
                        Please type "DELETE" (without quotes) below to confirm.
                    </p>
                </div>
                <div class="field">
                    <div class="control">
                        <input class="input is-medium" type="text" autofocus v-model="confirm">
                    </div>
                </div>
            </section>
            <footer class="modal-card-foot" style="justify-content: flex-end;">
                <div class="buttons">
                    <a class="button" @click="closeModal">Cancel</a>
                    <button class="button is-danger" :disabled="!enabled"
                        onclick="event.preventDefault();
                                document.getElementById('deck-delete-form').submit();">
                        <span class="icon">
                            <i class="fa fa-trash-o"></i>
                        </span>
                        <span>Delete</span>
                    </button>
                </div>
                <form id="deck-delete-form" :action="deleteRoute" method="POST" style="display: none;">
                    <input name="_method" type="hidden" value="DELETE">
                    <input type="hidden" name="_token" :value="csrf">
                </form>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        props: [ 'csrf', 'deleteRoute'],
        data() {
            return {
                confirm: ''
            }
        },
        computed : {
            enabled() {
                return this.confirm === 'DELETE';
            },
            isVisible() {
                return this.$store.getters.deleteModal.visible;
            }
        },
        methods  : {
            closeModal() {
                this.$store.dispatch( {
                    type : 'hideDeleteModal'
                } );
            }
        }
    };
</script>
