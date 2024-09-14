<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; // Add this line
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
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::middleware(['auth'])->group(function () {
        Route::middleware(['customer'])->group(function () {
            Route::get('/', [CustomerController::class, 'home'])->name('customer.home');
        });
        Route::middleware(['admin'])->group(function () {
            Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        });

        Route::middleware(['super-admin'])->group(function () {
            Route::get('/super-admin', [SuperAdminController::class, 'index'])->name('superAdmin.index');
        });
    });
});
