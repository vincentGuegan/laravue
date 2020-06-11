<template>
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-3" data-toggle="modal" data-target="#exampleModal">
            Ajouter une tâche
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="">Nom de la tâche</label>
                        <textarea name="name" id="name" rows="4" class="form-control"
                        v-model="name"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-success" @click="taskStore">Créer ma tâche</button>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
export default {

    data() {
        return {
            name: ''
        }
    },

    methods: {
        taskStore() {
            axios.post('http://laravue.test/tasksList', {
                name: this.name // I send the name in db, so I have to take care of the TaskController to save what has been sent
            })
            .then(response => this.$emit('task-added', response)) // I get back data by creating this genuine event to get back the list of added tasks
            .catch(error => console.log(error));
        }
    }
}
</script>