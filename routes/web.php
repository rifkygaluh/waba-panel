<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\LandingPageController;

//Landing Page
Route::get('home', [LandingPageController::class, 'home']);
Route::get('about-us', [LandingPageController::class, 'about']);
Route::get('faq', [LandingPageController::class, 'faq']);
Route::get('terms-n-conditions', [LandingPageController::class, 'terms']);
Route::get('privacy-policy', [LandingPageController::class, 'privacy']);

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('welcome', function () {
    return Inertia::render('Welcome');
})->name('welcome');

require __DIR__.'/settings.php';
