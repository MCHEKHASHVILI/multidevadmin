<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\TemporaryFile;

class PostObserver
{
    public function created(Post $post)
    {
        if (request()->has('avatar')) {
            $tempFile = TemporaryFile::where('directory', request()->avatar)->first();

            if ($tempFile) {
                $post->addMedia(
                    storage_path('app/public/_temp/' . request()->avatar . '/' . $tempFile->file_name)
                )->toMediaCollection('avatar');

                rmdir(storage_path('app/public/_temp/' . request()->avatar));

                $tempFile->delete();
            }
        }


    }

    public function updated(Post $post)
    {
        // if (!request()->has('avatar')) { return false; }

        // $tempFile = TemporaryFile::where('directory', request()->avatar)->first();

        // if (!$tempFile) { return false; }

        // $post->clearMediaCollection('avatar');

        // $post->addMedia(
        //     storage_path('app/public/_temp/' . request()->avatar . '/' . $tempFile->file_name)
        // )->toMediaCollection('avatar');

        // rmdir(storage_path('app/public/_temp/' . request()->avatar));

        // $tempFile->delete();
    }
}
