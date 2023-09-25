<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return inertia('Posts/Posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Posts/CreatePost');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = Post::create($request->all());

        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     */
    public function show(Post $post)
    {
        return inertia('Posts/EditPost', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     */
    public function edit(Post $post)
    {
        return inertia('Posts/EditPost', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\Post $post
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());

        if($request->hasFile('avatar')){
            $post->clearMediaCollection('avatar');
            $post->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        return inertia('Posts/EditPost', compact('post'));
        // return to_route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // return to_route('posts.index');
    }
}
