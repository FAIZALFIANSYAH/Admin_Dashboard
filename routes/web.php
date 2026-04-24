<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController; // Tambahan Breeze
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ExpertiseController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\UserController;
use App\Models\User;
use App\Http\Controllers\Admin\RoleController;
use App\Models\Role;
/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Protected Admin Routes (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function (Request $request) {
        $user = $request->user();

        $fallbackRoutes = [
            'dashboard' => 'Dashboard.index',
            'hero' => 'hero.index',
            'about' => 'about.index',
            'expertise' => 'expertise.index',
            'tools' => 'tools.index',
            'experience' => 'experience.index',
            'project' => 'project.index',
            'video' => 'video.index',
            'contact' => 'contact.index',
            'products' => 'products.index',
        ];

        foreach ($fallbackRoutes as $permission => $route) {
            if ($user->can($permission)) {
                return redirect()->route($route);
            }
        }

        return redirect()->route('profile.edit');
    })->name('dashboard');

    Route::middleware('permission:dashboard.index')->group(function () {
        Route::get('/Dashboard', [DashboardController::class, 'index'])->name('Dashboard.index');
    });

    Route::middleware('permission:project.index')->group(function () {
        Route::resource('admin/project', ProjectController::class)->except(['show'])->names([
            'index' => 'project.index',
            'create' => 'project.create',
            'store' => 'project.store',
            'edit' => 'project.edit',
            'update' => 'project.update',
            'destroy' => 'project.destroy',
        ]);
    });

    Route::middleware('permission:hero.index')->group(function () {
        Route::get('/admin/hero', [HeroController::class, 'index'])->name('hero.index');
        Route::get('/admin/hero/{id}/edit', [HeroController::class, 'edit'])->name('hero.edit');
        Route::put('/admin/hero/{id}', [HeroController::class, 'update'])->name('hero.update');
        Route::delete('/admin/hero/delete-image/{id}', [HeroController::class, 'deleteImage'])->name('hero.deleteImage');
    });

    Route::middleware('permission:about.index')->group(function () {
        Route::get('/admin/about', [AboutController::class, 'index'])->name('about.index');
        Route::get('/admin/about/{id}/edit', [AboutController::class, 'edit'])->name('about.edit');
        Route::put('/admin/about/{id}', [AboutController::class, 'update'])->name('about.update');
    });

    Route::middleware('permission:expertise.index')->group(function () {
        Route::resource('admin/expertise', ExpertiseController::class)->except(['show'])->names([
            'index' => 'expertise.index',
            'create' => 'expertise.create',
            'store' => 'expertise.store',
            'edit' => 'expertise.edit',
            'update' => 'expertise.update',
            'destroy' => 'expertise.destroy',
        ]);
    });

    Route::middleware('permission:tools.index')->group(function () {
        Route::resource('admin/tools', ToolController::class)->except(['show'])->names([
            'index' => 'tools.index',
            'create' => 'tools.create',
            'store' => 'tools.store',
            'edit' => 'tools.edit',
            'update' => 'tools.update',
            'destroy' => 'tools.destroy',
        ]);
    });

    Route::middleware('permission:experience.index')->group(function () {
        Route::resource('admin/experience', ExperienceController::class)->except(['show'])->names([
            'index' => 'experience.index',
            'create' => 'experience.create',
            'store' => 'experience.store',
            'edit' => 'experience.edit',
            'update' => 'experience.update',
            'destroy' => 'experience.destroy',
        ]);
    });

    Route::middleware('permission:products.index')->group(function () {
        Route::resource('products', ProductController::class);
    });

    Route::middleware('permission:video.index')->group(function () {
        Route::resource('admin/video', VideoController::class)->except(['show'])->names([
            'index' => 'video.index',
            'create' => 'video.create',
            'store' => 'video.store',
            'edit' => 'video.edit',
            'update' => 'video.update',
            'destroy' => 'video.destroy',
        ]);
    });

    Route::middleware('permission:contact.index')->group(function () {
        Route::resource('admin/contact', ContactController::class)->only(['index', 'update'])->names([
            'index' => 'contact.index',
            'update' => 'contact.update',
        ]);

        Route::post('admin/social-links', [ContactController::class, 'addSocial'])->name('social.add');
        Route::delete('admin/social-links/{id}', [ContactController::class, 'deleteSocial'])->name('social.delete');
    });

    Route::middleware('permission:users.index')->group(function () {
        Route::resource('admin/users', UserController::class)->except(['show'])->names([
            'index' => 'users.index',
            'create' => 'users.create',
            'store' => 'users.store',
            'edit' => 'users.edit',
            'update' => 'users.update',
            'destroy' => 'users.destroy',
        ]);
    });

    // Profile Settings (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('admin/roles', RoleController::class)->except(['show'])->names([
        'index' => 'roles.index',
        'create' => 'roles.create',
        'store' => 'roles.store',
        'edit' => 'roles.edit',
        'update' => 'roles.update',
        'destroy' => 'roles.destroy',
    ])->middleware('permission:roles.index');
});

// Auth Routes (Login, Register, dsb)
require __DIR__ . '/auth.php';
