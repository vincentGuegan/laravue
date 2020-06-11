<template>
    <div class="container">
            <ul class="list-group">
                <li class="list-group-item" v-for="task in tasks.data" :key="task.id"> <!-- Add of .data to link the pagination library -->
                    <a href="#">{{ task.name }}</a>
                </li>
            </ul>
            <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
    </div>
</template>

<script>
    export default {

        data() { // I have a property data which is a function
            return { // this property data returns an object (here tasks)
                tasks: {} // tasks here is also an object with many informations in it, I can access to it in my vuejs component by doing this.tasks in my below axios response
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
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
