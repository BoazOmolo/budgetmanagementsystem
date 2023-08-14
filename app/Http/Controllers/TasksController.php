<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Task;
use App\Models\Project;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();
        $tasks = Task::all();

        return view('tasks.create',compact('projects','tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $username = Auth::user()->name;

        $task = new Task();
        $task->project_id = $request->input('project_id');
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        // $task->status = $request->input('status');
        $task->status = 'In Progress';
        $task->createdby = $username;
        $task->updatedby = "";
        $task->deletedby = "";

        $task->save();

        Session::flash('successcode','success');
        return redirect()->route('tasks.index')->with('success', 'Task added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $tasks = Task::pluck('name', 'id');
        $projects = Project::all();
        
        return view('tasks.edit', compact('task','tasks','projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $username = Auth::user()->name;

        $task = Task::findOrFail($id);
        $task->project_id = $request->input('project_id');
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        // $task->status = $request->input('status');
        $task->status = 'Complete';
        $task->updatedby = $username;

        $task->save();

        unset($task->updated_at);

        Session::flash('successcode','success');
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $username = Auth::user()->name;

        $task = Task::findOrFail($id);
        $task->deletedby = $username;
        $task->save();

        $task->delete();

        Session::flash('successcode','warning');
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
