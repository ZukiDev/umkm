<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; // Add this line
use App\Http\Controllers\CustomerController; // Add this line
use App\Http\Controllers\AdminController; // Add this line
use App\Http\Controllers\SuperAdminController; // Add this line

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session', 'default'),
    'verified',
])->group(function () {

    Route::middleware(['auth'])->group(function () {
        Route::middleware(['customer'])->group(function () {
            // Route::get('/profile', [CustomerController::class, 'profile'])->name('customer.profile');
        });
        Route::middleware(['admin'])->group(function () {
            Route::get('/dashboard-admin', [AdminController::class, 'index'])->name('admin.index');
        });

        Route::middleware(['super-admin'])->group(function () {
            Route::get('/dashboard-superadmin', [SuperAdminController::class, 'index'])->name('superadmin.index');
        });
    });
});
