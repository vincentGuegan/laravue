<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // this index function is going to get the tasks information in the db and resend them under json format
    {
        $tasks = Task::orderBy('created_at', 'DESC')->paginate(3); // to get a choose number of task per page, ordered from the oldest to the newest

        return response()->json($tasks); // return task info in json format
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = Task::create($request->all()); // This enables Laravel to fulfill the information, but I have to precise in my task model what exactely I authorized (it will be the name)
    
        if ($task) { // if task, it will refresh directly my task list by a json response which will have the task that I just added
            return $this->refresh(); // refresh() is a private function (at the bottom) because the code is the same for the function store and the function update
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // to get back by id
    {
        $task = Task::find($id);  // find by id
            return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $task = Task::find($id); // find by id
        $task->name = request('name'); // the name is what I refind in my request
        $task->save(); // I persist it in database with the function save()
            
        if($task) {
            return $this->refresh(); // refresh() is a private function (at the bottom) because the code is the same for the function store and the function update
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id); // find by id

        if ($task->delete()) {
            return $this->refresh();
        } else {
            return response()->json(['error' => 'Destroy method has failed.'], 425);
        }
    }

    private function refresh()
    {
        $tasks = Task::orderBy('created_at', 'DESC')->paginate(3);
        return response()->json($tasks);
    }
}
