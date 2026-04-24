<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\PermissionRegistrar;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        Gate::before(fn ($user) => $user->hasRole('superadmin') ? true : null);
        Gate::define('users.index', fn ($user) => $user->hasRole('superadmin'));
        Gate::define('roles.index', fn ($user) => $user->hasRole('superadmin'));
    }
}
