<?php

use App\Http\Controllers\BenefitRulesController;
use App\Http\Controllers\InvoiceHistoryController;
use App\Http\Controllers\InvoiceVerificationController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\LandingPageController;

//Landing Page
Route::get('/', [LandingPageController::class, 'home'])->name('home');
// Route::get('about-us', [LandingPageController::class, 'about']);
Route::get('faq', [LandingPageController::class, 'faq']);
Route::get('terms-n-conditions', [LandingPageController::class, 'terms']);
Route::get('privacy-policy', [LandingPageController::class, 'privacy']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('invoice')->group(function () {
        Route::get('verification', [InvoiceVerificationController::class, 'index'])->name('invoice.verification.index');
        Route::get('verification/{id}', [InvoiceVerificationController::class, 'show'])->name('invoice.verification.show');

        Route::get('history', [InvoiceHistoryController::class, 'index'])->name('invoice.history');
    });

    Route::resource('product', ProductController::class);

    Route::resource('benefit-rules', BenefitRulesController::class);
});

require __DIR__.'/settings.php';
