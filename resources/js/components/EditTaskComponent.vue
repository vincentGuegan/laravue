<template>
    <div>
        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="">Nom de la tâche</label>
                        <textarea name="name" id="name" rows="4" class="form-control"
                        v-model="taskToEdit.name"></textarea> <!-- I precise here what information I want to get, here it is the name, that is to say the k ey of the model I desire -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-success" @click="update"
                data-dismiss="modal">Enregistrer</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['taskToEdit'], // props are a board enabling us to pass data from one component to another

    methods: {
        update() {
            axios.patch('http://laravue.test/tasks/edit/' + this.taskToEdit.id, { // I get the id directly from my prop
                name: this.taskToEdit.name // I pass the name to the controller because I have to resave the task
            })
            .then(response => this.$emit('task-updated', response)) //we create an event called 'task-updated' and we pass to it the response
            .catch(error => console.log(error));
        }
    }
}
</script>