<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return Inertia::render('Dashboard', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
    $resources = [
        "projects" => [
            "title" => "Projects",
            "route" => "projects.index",
            "count" => count(\App\Models\Project::all()),
        ],
        "posts" => [
            "title" => "Blog Posts",
            "route" => "posts.index",
            "count" => count(\App\Models\Post::all()),
        ],
        "clients" => [
            "title" => "Client Reviews",
            "route" => "clients.index",
            "count" => count(\App\Models\Client::all()),
        ],
    ];

    return inertia('Dashboard', compact('resources'));

})->middleware(['auth', 'verified'])->name('home');

Route::get('/dashboard', function () {
    $resources = [
        "projects" => [
            "title" => "Projects",
            "route" => "projects.index",
            "count" => count(\App\Models\Project::all()),
        ],
        "posts" => [
            "title" => "Blog Posts",
            "route" => "posts.index",
            "count" => count(\App\Models\Post::all()),
        ],
        "clients" => [
            "title" => "Client Reviews",
            "route" => "clients.index",
            "count" => count(\App\Models\Client::all()),
        ],
    ];

    return inertia('Dashboard', compact('resources'));

})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('posts', PostController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('clients', ClientController::class);
    Route::post('uploads', [ UploadController::class, 'store' ])->name('uploads.store');
});

Route::post('uploads/gallery', [ UploadController::class, 'gallery' ])->name('uploads.gallery');

require __DIR__.'/auth.php';
