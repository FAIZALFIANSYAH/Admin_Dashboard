<?php

use Illuminate\Support\Facades\Route;
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

    // Main Dashboard
    Route::get('/Dashboard', [DashboardController::class, 'index'])->name('Dashboard.index');

    // Breeze Dashboard (Opsional, bawaan Breeze)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Products
    Route::resource('products', ProductController::class);

    // Hero Section
    Route::get('/admin/hero', [HeroController::class, 'index'])->name('hero.index');
    Route::get('/admin/hero/{id}/edit', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('/admin/hero/{id}', [HeroController::class, 'update'])->name('hero.update');
    Route::delete('/admin/hero/delete-image/{id}', [HeroController::class, 'deleteImage'])->name('hero.deleteImage');

    // About Section
    Route::get('/admin/about', [AboutController::class, 'index'])->name('about.index');
    Route::get('/admin/about/{id}/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/admin/about/{id}', [AboutController::class, 'update'])->name('about.update');

    // Expertise
    Route::resource('admin/expertise', ExpertiseController::class)->names([
        'index' => 'expertise.index',
        'create' => 'expertise.create',
        'store' => 'expertise.store',
        'edit' => 'expertise.edit',
        'update' => 'expertise.update',
        'destroy' => 'expertise.destroy',
    ]);

    // Tools
    Route::resource('admin/tools', ToolController::class)->names([
        'index' => 'tools.index',
        'create' => 'tools.create',
        'store' => 'tools.store',
        'edit' => 'tools.edit',
        'update' => 'tools.update',
        'destroy' => 'tools.destroy',
    ]);

    // Experience
    Route::resource('admin/experience', ExperienceController::class)->names([
        'index' => 'experience.index',
        'create' => 'experience.create',
        'store' => 'experience.store',
        'edit' => 'experience.edit',
        'update' => 'experience.update',
        'destroy' => 'experience.destroy',
    ]);

    // Project
    Route::resource('admin/project', ProjectController::class)->names([
        'index' => 'project.index',
        'create' => 'project.create',
        'store' => 'project.store',
        'edit' => 'project.edit',
        'update' => 'project.update',
        'destroy' => 'project.destroy',
    ]);

    // Video
    Route::resource('admin/video', VideoController::class)->names([
        'index' => 'video.index',
        'create' => 'video.create',
        'store' => 'video.store',
        'edit' => 'video.edit',
        'update' => 'video.update',
        'destroy' => 'video.destroy',
    ]);

    // Contact
    Route::resource('admin/contact', ContactController::class)->names([
        'index' => 'contact.index',
        'update' => 'contact.update',
    ]);

    // Social Links khusus
    Route::post('admin/social-links', [ContactController::class, 'addSocial'])->name('social.add');
    Route::delete('admin/social-links/{id}', [ContactController::class, 'deleteSocial'])->name('social.delete');

    // Profile Settings (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Routes (Login, Register, dsb)
require __DIR__ . '/auth.php';
