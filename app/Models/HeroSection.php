<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
    'badge', 
    'headline', 
    'subheadline', 
    'cta_text', 
    'cta_link', 
    'image_url'
];
}
