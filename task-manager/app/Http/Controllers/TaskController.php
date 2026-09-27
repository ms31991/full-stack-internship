<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('project')->get();

        return TaskResource::collection($tasks);
    }

    public function show($id)
    {
        $task = Task::with('project')->find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        }

        Gate::authorize('view', $task);

        return new TaskResource($task);
    }

    public function store(StoreTaskRequest $request)
    {
        $projectId = $request->validated()['project_id'];

        $project = \App\Models\Project::find($projectId);

        if (!$project) {
            return response()->json([
                'message' => 'Project not found'
            ], 404);
        }

        Gate::authorize('update', $project);

        $task = Task::create($request->validated());

        $task->load('project');

        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::with('project')->find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        }

        Gate::authorize('update', $task);

        $task->update($request->validated());

        $task->load('project');

        return new TaskResource($task);
    }

    public function destroy($id)
    {
        $task = Task::with('project')->find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        }

        Gate::authorize('delete', $task);

        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully'
        ], 200);
    }
}