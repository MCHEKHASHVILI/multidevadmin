<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function created(Post $post){
        // adding media once created
        if(request()->hasFile('avatar')){
            $post->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }
    }

    public function updated(Post $post)
    {
        if (request()->hasFile('avatar')) {
            $post->clearMediaCollection('avatar');
            $post->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }
    }

}
