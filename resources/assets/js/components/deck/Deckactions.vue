<template>
    <section class="section">
        <DeleteModal :csrf="csrf" :deleteRoute="deleteroute"></DeleteModal>
        <div class="container">
            <hr/>
            <div class="buttons is-pulled-right">
                <a :href="editroute" class="button is-primary">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Deck</span>
                </a>
                <button class="button is-danger" @click="showDeleteModal">
                    <span class="icon">
                        <i class="fa fa-trash-o"></i>
                    </span>
                    <span>Delete</span>
                </button>
            </div>
            <div class="is-clearfix"></div>
        </div>
    </section>
</template>

<script>
import DeleteModal from './Deletemodal.vue';

export default {
    props : [ 'id', 'editroute', 'deleteroute', 'csrf' ],
    components : {
        DeleteModal
    },
    mounted() {
        console.log('editRoute', this.editRoute);
    },
    methods: {
        showDeleteModal() {
            this.$store.dispatch( {
                type : 'showDeleteModal'
            } );
        }
    }
};
</script>

