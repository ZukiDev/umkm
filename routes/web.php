<?php

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\customer\CartController;
use App\Http\Controllers\customer\ProductController;
use App\Http\Controllers\customer\OrderController;
use App\Http\Controllers\SuperAdmin\CategoryController;
use App\Http\Controllers\SuperAdmin\StoreController;
use App\Http\Controllers\SuperAdmin\CustomerController as SuperAdminCustomerController;
use App\Http\Controllers\SuperAdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session', 'default'),
    'verified',
])->group(function () {

    Route::middleware(['auth'])->group(function () {
        Route::middleware(['customer'])->group(function () {
            Route::get('/profile', [CustomerController::class, 'profile'])->name('customer.profile');
            Route::resource('/cart', CartController::class)->names('customer.cart');
            Route::resource('/product', ProductController::class)->names('customer.product');
            // Route::get('/detail-product/{id}', [CustomerController::class, 'detailProduct'])->name('customer.product.detail');
            Route::resource('/order', OrderController::class)->names('customer.order');
            Route::get('/checkout', [OrderController::class, 'create'])->name('customer.checkout');
        });
        Route::middleware(['admin'])->group(function () {
            Route::prefix('admin')->group(function () {
                Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
                Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
                Route::resource('/product', AdminProductController::class)->names('admin.product');
            });
        });

        Route::middleware(['super-admin'])->group(function () {
            Route::prefix('super-admin')->group(function () {
                Route::get('/profile', [SuperAdminController::class, 'profile'])->name('superadmin.profile');
                Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.index');
                Route::resource('/dashboard/data-master/umkm', StoreController::class)->names('superadmin.data-master.umkm');
                Route::resource('/dashboard/data-master/customer', SuperAdminCustomerController::class)->names('superadmin.data-master.customer');
                Route::resource('/dashboard/data-master/category', CategoryController::class)->names('superadmin.data-master.category');
            });
        });
    });
});
