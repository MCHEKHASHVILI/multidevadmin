<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Projects\ProjectResource;
use App\Http\Requests\Projects\ProjectStoreRequest;
use App\Http\Requests\Projects\ProjectUpdateRequest;
use App\Http\Resources\Projects\ProjectListResource;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = ProjectListResource::collection(Project::all());

        return inertia('Projects/Projects', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Projects/CreateProject');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Projects\ProjectStoreRequest $request
     */
    public function store(ProjectStoreRequest $request)
    {
        $project = $request->user()->projects()->create($request->validated());

        return to_route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Project $project
     */
    public function show(Project $project)
    {
        $project = ProjectResource::make($project);

        return inertia('Projects/EditProject', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Project $project
     */
    public function edit(Project $project)
    {
        return inertia('Projects/EditProject', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Projects\ProjectUpdateRequest $request
     * @param \App\Models\Project $project
     */
    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $project->update($request->validated());

        // dd($project);

        // if($request->hasFile('avatar')){
        //     $project->clearMediaCollection('avatar');
        //     $project->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        // }

        return to_route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
