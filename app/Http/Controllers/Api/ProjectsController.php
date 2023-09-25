<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Resources\Projects\ProjectListResource;
use App\Http\Resources\Projects\ProjectResource;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProjectListResource::collection(Project::all());
    }

    /**
     * Display the specified resource
     *
     * @param \App\Models\Project $project
     *
     * @return App\Http\Resources\Projects\ProjectResource
     */
    public function show(Project $project)
    {
        return ProjectResource::make($project);
    }
}
