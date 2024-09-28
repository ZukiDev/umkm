<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session', 'default'),
    'verified',
])->group(function () {

    Route::middleware(['auth'])->group(function () {
        Route::middleware(['customer'])->group(function () {
            Route::get('/profile', [CustomerController::class, 'profile'])->name('customer.profile');
        });
        Route::middleware(['admin'])->group(function () {
            Route::prefix('admin')->group(function () {
                Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
            });
        });

        Route::middleware(['super-admin'])->group(function () {
            Route::prefix('super-admin')->group(function () {
                Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('super-admin.index');
                Route::get('/profile', [SuperAdminController::class, 'profile'])->name('super-admin.profile');
            });
        });
    });
});
