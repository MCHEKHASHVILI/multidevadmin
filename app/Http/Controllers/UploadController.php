<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$request->hasFile('tempFile')) {
            return false;
        }

        $file = $request->file('tempFile');
        $folder = uniqid() . '-' . now()->timestamp;
        $fileName = $file->getClientOriginalName();
        $file->storeAs('public/_temp/' . $folder, $fileName);

        TemporaryFile::create([
            'directory' => $folder,
            'file_name' => $fileName,
        ]);

        return $folder;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

     /**
     * Store a newly created resource in storage Gallery.
     */
    public function gallery(Request $request)
    {
        if($request->hasFile('upload')){
            $file = $request->file('upload');
            $folder = uniqid() . '-' . now()->timestamp;
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/gallery/' . $folder, $fileName);
            return response()->json([
                "uploaded" => 1,
                "fileName" => $fileName,
                "url" => Storage::url('public/gallery/' . $folder . '/' . $fileName)
            ]);
        }
    }
}
