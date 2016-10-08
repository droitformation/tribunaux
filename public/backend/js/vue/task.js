new Vue({

    el: '#tasks',

    data: {
        tasks: [],

        newTask: '',

        filters: {
            inProcess: function(task) {
                return ! task.completed;
            },

            completed: function(task) {
                return task.completed;
            }
        }
    },

    computed: {
        completions: function() {
            return this.tasks.filter(this.filters.completed);
        },

        remaining: function() {
            return this.tasks.filter(this.filters.inProcess);
        }
    },

    methods: {
        addTask: function(e) {
            e.preventDefault();

            if ( ! this.newTask) return;

            this.tasks.push({
                body: this.newTask,
                completed: false
            });

            this.newTask = '';
        },

        editTask: function(task) {
            this.removeTask(task);
            this.newTask = task.body;

            this.$$.newTask.focus();
        },

        toggleTaskCompletion: function(task) {
            task.completed = ! task.completed;
        },

        completeAll: function() {
            this.tasks.forEach(function(task) {
                task.completed = true;
            });
        },

        clearCompleted: function() {
            this.tasks = this.tasks.filter(this.filters.inProcess);
        },

        removeTask: function(task) {
            this.tasks.$remove(task);
        }
    }

});



new Vue({
    el: '#list',
    data: {
        listX: ['a', 'b', 'c', 'd'],
        listY: ['A', 'B', 'C', 'D'],
    },
    methods: {
        sort: function(list, id, tag, data) {
            var tmp = list[data.index];
            list.splice(data.index, 1);
            list.splice(id, 0, tmp);
        },
        move: function(from, to, id, tag, data) {
            var tmp = from[data.index];
            from.splice(data.index, 1);
            to.splice(id, 0, tmp);
        },
        remove: function(from, tag, data) {
            from.splice(data.index, 1);
        }
    }
});