<?php

namespace App\Observers;

use App\Models\Project;

// use Illuminate\Support\Facades\Request;

class ProjectObserver
{
    public function created(Project $project)
    {

        if (request()->hasFile('avatar')) {
            $project->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        $project->setStatus((request()->has('status'))
                ? request()->validated(["status"])
                : "created",
            "created"
        );
    }

    public function updated(Project $project)
    {
        if (request()->hasFile('avatar')) {
            $project->clearMediaCollection('avatar');
            $project->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        $project->setStatus((request()->has('status'))
                ? request()->validated(["status"])
                : "updated",
            "updated"
        );
    }


    // public function updated(Project $project){
    // dd(request()->hasFile('avatar'));
    // }

}
