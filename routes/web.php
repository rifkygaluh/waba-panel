<?php

use App\Http\Controllers\AuthController;
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

Route::middleware('guest_api')->group(function () {
    Route::get('login', [AuthController::class, 'index'])->name('auth.login.index');
    Route::post('login', [AuthController::class, 'store'])->name('auth.login.store');
});

Route::middleware('auth_api')->group(function () {
    Route::post('logout', [AuthController::class, 'destroy'])->name('auth.logout');
    
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

    Route::prefix('api')->group(function () {
        Route::get('invoice/verification', [InvoiceVerificationController::class, 'indexApi'])->name('invoice.verification.api');
        Route::get('invoice/history', [InvoiceHistoryController::class, 'indexApi'])->name('invoice.history.api');

        Route::get('product', [ProductController::class, 'indexApi'])->name('product.api');
    });
});

require __DIR__.'/settings.php';
