<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PortfolioController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('portfolio')->group(function () {
    Route::get('/all', [PortfolioController::class, 'index']);      // Data lengkap (untuk awal loading)
    Route::get('/hero', [PortfolioController::class, 'hero']);     // Cukup data Hero
    Route::get('/about', [PortfolioController::class, 'about']);   // About + Expertises + Tools
    Route::get('/experiences', [PortfolioController::class, 'experiences']);
    Route::get('/projects', [PortfolioController::class, 'projects']); // Semua Projects
    Route::get('/projects/{slug}', [PortfolioController::class, 'projectDetail']); // Detail 1 Project
    Route::get('/videos', [PortfolioController::class, 'videos']); // Video Reels
    Route::get('/contact', [PortfolioController::class, 'contact']); // Contact & Socials
});
