<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute; // Tambahkan ini

class Project extends Model
{
    protected $fillable = ['title', 'slug', 'category', 'year', 'thumbnail', 'description'];

    public function images()
    {
        return $this->hasMany(ProjectImage::class, 'project_id');
    }

    // Menambahkan domain ke URL thumbnail secara otomatis
    protected function thumbnail(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? asset('storage/' . $value) : null,
        );
    }
}
