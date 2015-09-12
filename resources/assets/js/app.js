/*jslint browser: true*/
/*global Vue*/
(function (exports) {
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

    exports.app = new Vue({
        el: '#todoapp',
        data: {
            newTask: '',
            editedTask: null,
            tasks: [],
        },

        ready: function () {
            this.fetchTasks();
        },

        methods: {
            fetchTasks: function () {
                this.$http.get('api/tasks', function (tasks) {
                    this.$set('tasks', tasks);
                })
                    .error(function () {
                        console.log('Fetching tasks failed.');
                    });
            },

            addTask: function () {
                var value = this.newTask && this.newTask.trim();

                if (!value) {
                    return;
                }

                var task = { body: value, completed: false };

                this.tasks.push(task);

                this.newTask = '';

                this.$http.post('api/tasks', task);
            },

            toggleTaskCompletion: function (task) {
                task.completed = !task.completed;
                this.$http.put('api/tasks/' + task.id, task);
            },

            removeTask: function (task) {
                this.tasks.$remove(task);
                this.$http.delete('api/tasks/' + task.id, task);
            },

            editTask: function (task) {
                this.beforeEditCache = task.body;
                this.editedTask = task;
            },

            doneEdit: function (task) {
                if (!this.editedTask) {
                    return;
                }

                this.editedTask = null;

                task.body = task.body.trim();

                // if manually backspaced, manually delete
                if (!task.body) {
                    this.removeTask(task);
                }

                this.$http.put('api/tasks/' + task.id, task);
            },

            cancelEdit: function (task) {
                task.body = this.beforeEditCache;
                this.editedTask = null;
            },

            completeAll: function () {
                this.tasks.forEach(function (task) {
                    task.completed = true;
                });

                // ajax request
                this.$http.post('api/tasks/complete-all');
            },

            clearCompleted: function () {

                this.tasks = this.tasks.filter(function (task) {
                    return !task.completed;
                });

                // ajax request
                this.$http.post('api/tasks/clear-completed');
            }
        },

        directives: {
            'todo-focus': function (value) {
                if (!value) {
                    return;
                }
                var el = this.el;
                setTimeout(function () {
                    el.focus();
                }, 0);
            }
        },

        computed: {
            remaining: function () {
                return this.tasks.filter(function (task) {
                    return !task.completed;
                });
            }
        }
    });
}(window));