<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Project;
use App\Observers\PostObserver;
use App\Observers\ProjectObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Project::observe(ProjectObserver::class);
        Post::observe(PostObserver::class);
        JsonResource::withoutWrapping();
    }
}
