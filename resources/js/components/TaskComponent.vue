<template>
    <div class="container">
            <div class="form-row">
                <div class="col-row">
                    <input type="text" class="form-control" @keyup="searchTask" v-model="q"
                    placeholder="Rechercher une tâche...">
                </div>
            </div>
            <add-task @task-added="refresh"></add-task>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between aligns-items-center"
                v-for="task in tasks.data" :key="task.id"> <!-- Add of .data to link the pagination library -->
                    <a href="#">{{ task.name }}</a>
                        <div>
                            <button type="button" class="btn btn-secondary my-3" data-toggle="modal"
                            data-target="#editModal" @click="getTask(task.id)">
                                Editer
                            </button>
                            <button type="button" class="btn btn-danger"
                            @click="deleteTask(task.id)">
                                Supprimer
                            </button>
                        </div>
                </li>
                <edit-task v-bind:taskToEdit="taskToEdit" @task-updated="refresh"></edit-task>
            </ul>
            <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
    </div>
</template>

<script>
    export default {

        data() { // I have a property data which is a function
            return { // this property data returns an object (here tasks)
                tasks: {}, // tasks here is also an object with many informations in it, I can access to it in my vuejs component by doing this.tasks in my below axios response
                taskToEdit: '',
                q: ''
           }
        },

        created() { // it is a function we use when we want to make calls to the db, with axios for example
            axios.get('http://laravue.test/tasksList') // when I call with axios this url
                .then(response => this.tasks = response.data) // I can stock my data in the tasks object in above data() by doing what's on the left
                .catch(error => console.log(error));
        },

        methods: {
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('http://laravue.test/tasksList?page=' + page)
                    .then(response => {
                        this.tasks = response.data;
                    });
            },

            getTask(id) {
                axios.get('http://laravue.test/tasks/edit/' + id) // this task will call a route in route/web.php
                    .then(response => this.taskToEdit = response.data) // the response will be equal to the data we got back, that is to say the concerned data of the task
                    .catch(error => console.log(error));
            },

            deleteTask(id) {
                axios.delete('http://laravue.test/tasks/' + id) // this task will call a route in route/web.php
                    .then(response => this.tasks = response.data) 
                    .catch(error => console.log(error));
            },

            searchTask() {
                if (this.q.length > 3) {
                    axios.get('http://laravue.test/tasksList/' + this.q)
                        .then(response => this.tasks = response.data)
                        .catch(error => console.log(error));
                } else {
                    axios.get('http://laravue.test/tasksList')
                        .then(response => this.tasks = response.data)
                        .catch(error => console.log(error));
                }
            },

            refresh(tasks) {
                this.tasks = tasks.data // I take the actual data and replace them by the latest tasks
            }
        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
