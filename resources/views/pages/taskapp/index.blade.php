@extends('app')


@section('head')
    @parent 
    <style>[v-cloak] { display: none; }</style>
@endsection


@section('content') 
    <div class="row" id="todoapp">
        <div class="col-xs-12">
            <h1>Vue Todo App</h1>
            <div class="form-group">
                <input 
                    autofocus
                    autocomplete ="off"
                    type         ="text" 
                    class        ="form-control"
                    placeholder  ="What needs to be done?"
                    v-model      ="newTask"
                    v-on         ="keyup: addTask | key 'enter', 
                                   blur: addTask">
            </div>
        </div>

        <div class="col-xs-6">
            <ul class="task-list list-group">
                <li class="task list-group-item"
                    v-repeat="task: tasks"
                    v-class="editing: task == editedTask, completed: task.completed">
                    <div class="view">
                        <span>@{{ task.body }}</span>

                        <div class="options">
                            <button v-on="click: toggleTaskCompletion(task)">
                                <i class="glyphicon glyphicon-ok"></i>
                            </button>
                            <button v-on="click: editTask(task)">
                                <i class="glyphicon glyphicon-edit"></i>
                            </button>
                            <button v-on="click: removeTask(task)">
                                <i class="glyphicon glyphicon-remove"></i>
                            </button>
                        </div>
                    </div>

                    <div class="edit">
                        <div class="form-group">
                            <input 
                                type         ="text" 
                                name         ="editTask" 
                                class        ="form-control"
                                v-model      ="task.body"
                                v-todo-focus ="task == editedTask"
                                v-on         ="keyup: doneEdit(task) | key 'enter', 
                                               blur: doneEdit(task), 
                                               keyup: cancelEdit(task) | key 'esc'">
                        </div>
                    </div>
                </li>
            </ul>

            <button class="btn btn-warning" v-on="click: completeAll" v-show="remaining.length">Complete All</button>
            <button class="btn btn-primary" v-on="click: clearCompleted" v-show="tasks.length > remaining.length">Clear Completed</button>

        </div>
        <div class="col-xs-6">
            <pre>
                @{{ $data | json }}
            </pre>
        </div>
    </div>
@endsection