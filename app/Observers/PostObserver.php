<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function created(Post $post){
        // adding media once created
        $post->addMediaFromRequest('avatar')->toMediaCollection('avatar');
    }

}
