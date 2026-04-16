<?php

use Illuminate\Support\Facades\Route;
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
 
Route::get('/', function () {
    return view('welcome');
});

Route::get('/Dashboard', [DashboardController::class, 'index'])->name('Dashboard.index');

Route::resource('products', ProductController::class);

Route::get('/admin/hero', [HeroController::class, 'index'])->name('hero.index');
Route::get('/admin/hero/{id}/edit', [HeroController::class, 'edit'])->name('hero.edit');
Route::put('/admin/hero/{id}', [HeroController::class, 'update'])->name('hero.update');

Route::get('/admin/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/admin/about/{id}/edit', [AboutController::class, 'edit'])->name('about.edit');
Route::put('/admin/about/{id}', [AboutController::class, 'update'])->name('about.update');

Route::resource('admin/expertise', ExpertiseController::class)->names([
    'index' => 'expertise.index',
    'edit' => 'expertise.edit',
    'update' => 'expertise.update',
]);


Route::resource('admin/tools', ToolController::class)->names([
    'index' => 'tools.index',
    'edit' => 'tools.edit',
    'update' => 'tools.update',
]);

Route::resource('admin/experience', ExperienceController::class)->names([
    'index' => 'experience.index',
    'edit' => 'experience.edit',
    'update' => 'experience.update',
]);


Route::resource('admin/project', ProjectController::class)->names([
    'index' => 'project.index',
    'edit' => 'project.edit',
    'update' => 'project.update',
]);


Route::resource('admin/video', VideoController::class)->names([
    'index' => 'video.index',
    'edit' => 'video.edit',
    'update' => 'video.update',
]);


Route::resource('admin/contact', ContactController::class)->names([
    'index' => 'contact.index',
    'update' => 'contact.update',
]);

// Route khusus untuk Social Links (karena dia bersifat list/banyak)
Route::post('admin/social-links', [ContactController::class, 'addSocial'])->name('social.add');
Route::delete('admin/social-links/{id}', [ContactController::class, 'deleteSocial'])->name('social.delete');