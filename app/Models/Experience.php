<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model {
    protected $fillable = [
        'position', 'company_name', 'location', 
        'start_year', 'end_year', 'is_current', 'description'
    ];
}