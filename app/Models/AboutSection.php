<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model {
    protected $fillable = ['description'];

    public function expertises() {
        return $this->hasMany(Expertise::class, 'about_id');
    }

    public function tools() {
        return $this->hasMany(Tool::class, 'about_id');
    }
}
