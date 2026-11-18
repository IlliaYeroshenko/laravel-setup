<?php

namespace App\Http\Controllers;

use App\Models\Project;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    public function index()
    {
        return ProjectResource::collection(
            Project::paginate(10)
        );
    }


    public function store(StoreProjectRequest $request)
    {
        $project = Project::create(
            $request->validated()
        );

        return new ProjectResource($project);
    }


    public function show(Project $project)
    {
        $project->load('tasks');

        return new ProjectResource($project);
    }


    public function update(
        UpdateProjectRequest $request,
        Project $project
    ) {
        $project->update(
            $request->validated()
        );

        return new ProjectResource($project);
    }


    public function destroy(Project $project)
    {
        $project->delete();

        return response()->noContent();
    }
}