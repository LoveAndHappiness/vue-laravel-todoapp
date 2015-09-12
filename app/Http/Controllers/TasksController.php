<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;
use Input;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return Task::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        Task::create(Input::all());

        return response()->json(['message' => 'Task successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        Task::where('id', $id)->update(Input::all());

        return response()->json(['message' => 'successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        Task::destroy($id);

        return response()->json(['message' => 'Success'], 200);
    }

    /**
     * Complete all tasks
     * @return [type] [description]
     */
    public function completeAll() 
    {
        $tasks = Task::where('completed', false)->get();

        foreach ($tasks as $task) {
            Task::where('id', $task->id)->update(['completed' => true]);
        }

        return response()->json(['message' => 'All tasks completed'], 200);
    }

    /**
     * Clear all completed tasks
     * @return [type] [description]
     */
    public function clearCompleted() 
    {
        $tasks = Task::where('completed', true)->get();

        foreach ($tasks as $task) {
            Task::where('id', $task->id)->delete();
        }

        return response()->json(['message' => 'Completed tasks removed'], 200);
    }
}
