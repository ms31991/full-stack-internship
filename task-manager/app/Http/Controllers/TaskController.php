<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return $tasks;
    }

    public function show($id)
    {
        $task = Task::find($id);

        return $task;
    }

    public function store(Request $request)
    {
        $task = Task::create([
            'project_id' => $request->project_id,
            'title' => $request->title,
            'status' => $request->status,
            'deadline' => $request->deadline,
        ]);

        return $task;
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        $task->update([
            'title' => $request->title,
            'status' => $request->status,
            'deadline' => $request->deadline,
        ]);

        return $task;
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully'
        ]);
    }
}