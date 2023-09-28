<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\TemporaryFile;
use App\Http\Resources\Posts\PostResource;
use App\Http\Requests\Posts\PostStoreRequest;
use App\Http\Requests\Posts\PostUpdateRequest;
use App\Http\Resources\Posts\PostListResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Posts/Posts', [
            "posts" => PostListResource::collection(Post::all())
        ]);
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
    public function store(PostStoreRequest $request)
    {

        $request->user()->posts()->create($request->validated());

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
        return inertia('Posts/EditPost', [
            "post" => PostResource::make($post)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Models\Post $post
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $post->update($request->validated());

        if ($request->has('avatar')) {
            $tempFile = TemporaryFile::where('directory', request()->avatar)->first();
            if ($tempFile) {
                $post->clearMediaCollection('avatar');
                $post->addMedia(
                    storage_path('app/public/_temp/' . request()->avatar . '/' . $tempFile->file_name)
                )->toMediaCollection('avatar');
                rmdir(storage_path('app/public/_temp/' . request()->avatar));
                $tempFile->delete();
            }
        }
        return to_route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->clearMediaCollection('avatar');

        $post->delete();

        return to_route('posts.index');
        // return to_route('posts.index');
    }
}
