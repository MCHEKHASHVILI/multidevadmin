<?php

namespace App\Models;

use App\Models\User;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Client extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'company',
        'url',
        'description',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();

        $this
            ->addMediaConversion('avatar')
            ->fit(Manipulations::FIT_CROP, 400, 400)
            ->nonQueued();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
