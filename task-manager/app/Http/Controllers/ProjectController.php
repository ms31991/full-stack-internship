<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return response()->json($projects, 200);
    }

    public function show($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'message' => 'Project not found'
            ], 404);
        }

        return response()->json($project, 200);
    }

    public function store(Request $request)
    {
        $project = Project::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json($project, 201);
    }

    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'message' => 'Project not found'
            ], 404);
        }

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json($project, 200);
    }

    public function destroy($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'message' => 'Project not found'
            ], 404);
        }

        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully'
        ], 200);
    }
}