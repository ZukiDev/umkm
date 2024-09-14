<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController; // Add this line
use App\Http\Controllers\AdminController; // Add this line
use App\Http\Controllers\SuperAdminController; // Add this line

Route::get('/', function () {
    return view('homepage');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session', 'default'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [CustomerController::class, 'home'])->name('customer.home');

        Route::middleware(['admin'])->group(function () {
            Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        });

        Route::middleware(['superadmin'])->group(function () {
            Route::get('/super-admin', [SuperAdminController::class, 'index'])->name('superadmin.index'); // Ensure 'superadmin' middleware is defined
            Route::get('/super-admin', [SuperAdminController::class, 'index'])->name('superadmin.index');
        });
    });
});
