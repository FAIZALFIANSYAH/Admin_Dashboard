<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute; // Tambahkan ini

class HeroSection extends Model
{
    protected $fillable = ['badge', 'headline', 'subheadline', 'cta_text', 'cta_link', 'image_url'];

    // Menambahkan domain ke URL gambar secara otomatis
    // protected function imageUrl(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn($value) => $value ? asset('storage/' . $value) : null,
    //     );
    // }
}
