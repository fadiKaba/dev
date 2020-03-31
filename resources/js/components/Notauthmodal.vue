<template>
    <div>
        <!-- Modal -->
        <div class="modal fade" id="not-auth-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               Please <a href="/login">login</a> or <a href="/register">Register</a> to be able to interact with our posts
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
        <!-- end Modal -->
    </div>
</template>
<script>
export default {
    name:'Notauthmodal'
}
</script>
<style scoped>

</style>