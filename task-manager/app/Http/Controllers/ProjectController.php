<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return $projects;
    }

    public function show($id)
    {
        $project = Project::find($id);

        return $project;
    }

    public function store(Request $request)
    {
        $project = Project::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return $project;
    }

    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return $project;
    }

    public function destroy($id)
    {
        $project = Project::find($id);

        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully'
        ]);
    }
}