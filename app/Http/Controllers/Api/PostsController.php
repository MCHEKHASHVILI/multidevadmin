<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\Posts\PostListResource;
use App\Http\Resources\Posts\PostResource;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PostListResource::collection(Post::all());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     */
    public function show(Post $post)
    {
        return PostResource::make($post);
    }
}
