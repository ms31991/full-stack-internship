<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['user', 'tasks'])->get();

        return ProjectResource::collection($projects);
    }

    public function show($id)
    {
        $project = Project::with(['user', 'tasks'])->find($id);

        if (!$project) {
            return response()->json([
                'message' => 'Project not found'
            ], 404);
        }

        Gate::authorize('view', $project);

        return new ProjectResource($project);
    }

    public function store(StoreProjectRequest $request)
    {
        Gate::authorize('create', Project::class);

        $project = Project::create([
            'user_id' => $request->user()->id,
            'title' => $request->validated()['title'],
            'description' => $request->validated()['description'] ?? null,
        ]);

        $project->load(['user', 'tasks']);

        return new ProjectResource($project);
    }

    public function update(UpdateProjectRequest $request, $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'message' => 'Project not found'
            ], 404);
        }

        Gate::authorize('update', $project);

        $project->update($request->validated());

        $project->load(['user', 'tasks']);

        return new ProjectResource($project);
    }

    public function destroy($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'message' => 'Project not found'
            ], 404);
        }

        Gate::authorize('delete', $project);

        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully'
        ], 200);
    }
}