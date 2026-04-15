<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    protected $fillable = ['title', 'slug', 'category', 'year', 'thumbnail', 'description'];

    public function images() {
        return $this->hasMany(ProjectImage::class, 'project_id');
    }
}