<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TemporaryFile extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['directory', 'file_name'];

}