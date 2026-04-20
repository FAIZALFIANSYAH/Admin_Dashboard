<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Video extends Model
{
    protected $fillable = ['title', 'video_url', 'thumbnail_url'];

    // protected function videoUrl(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn($value) => $value ? asset('storage/' . $value) : null,
    //     );
    // }

    // Jika nanti kamu mengisi thumbnail untuk video, tambahkan juga ini:
    // protected function thumbnailUrl(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn($value) => $value ? asset('storage/' . $value) : null,
    //     );
    // }
}
