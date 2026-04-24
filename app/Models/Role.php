<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Support\Str;

class Role extends SpatieRole
{
    protected $fillable = [
        'name',
        'guard_name',
        'slug',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $role): void {
            $role->slug ??= Str::slug($role->name);
            $role->guard_name ??= 'web';
        });
    }
}
