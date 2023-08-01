<?php

namespace App\Observers;

use App\Models\Project;

// use Illuminate\Support\Facades\Request;

class ProjectObserver
{
    public function created(Project $project){
        // adding media once created
        $project->addMediaFromRequest('avatar')->toMediaCollection('avatar');
    }

}
