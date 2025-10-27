<?php

use App\Http\Controllers\InvoiceHistoryController;
use App\Http\Controllers\InvoiceVerificationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('invoice')->group(function () {
        Route::get('verification', [InvoiceVerificationController::class, 'index'])->name('invoice.verification.index');
        Route::get('verification/{id}', [InvoiceVerificationController::class, 'show'])->name('invoice.verification.show');

        Route::get('history', [InvoiceHistoryController::class, 'index'])->name('invoice.history');
    });
});

require __DIR__.'/settings.php';
