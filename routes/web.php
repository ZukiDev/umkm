<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
//Admin
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OrderHistoryController;
//Customer
use App\Http\Controllers\customer\CartController;
use App\Http\Controllers\customer\ProductController;
use App\Http\Controllers\customer\OrderController;
use App\Http\Controllers\customer\CustomerProfileController;
//SuperAdmin
use App\Http\Controllers\SuperAdmin\CategoryController;
use App\Http\Controllers\SuperAdmin\StoreController;
use App\Http\Controllers\SuperAdmin\CustomerController as SuperAdminCustomerController;
use App\Http\Controllers\SuperAdmin\SuperAdminProfileController;
use App\Http\Controllers\SuperAdmin\SuperAdminDashboardController;

use Illuminate\Support\Facades\Artisan;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('/product', ProductController::class)->names('customer.product');
Route::get('/product/filter', [ProductController::class, 'filter'])->name('customer.product.filter');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session', 'default'),
    'verified',
])->group(function () {

    Route::middleware(['auth'])->group(function () {
        Route::middleware(['customer'])->group(function () {
            Route::post('/address', [CustomerProfileController::class, 'update'])->name('customer.profile.update');
            Route::resource('/cart', CartController::class)->names('customer.cart');
            Route::resource('/order', OrderController::class)->names('customer.order');
            Route::get('/checkout', [OrderController::class, 'create'])->name('customer.checkout');
        });
        Route::middleware(['admin'])->group(function () {
            Route::prefix('admin')->group(function () {
                // Route::resource('/profile', AdminProfileController::class)->names('admin.profile');
                Route::get('/profile', [AdminProfileController::class, 'index'])->name('admin.profile');
                Route::resource('/dashboard', AdminDashboardController::class)->names('admin.dashboard');
                Route::resource('/product', AdminProductController::class)->names('admin.product');
                Route::resource('/order', AdminOrderController::class)->names('admin.order');
                Route::resource('/history', OrderHistoryController::class)->names('admin.history');
            });
        });

        Route::middleware(['super-admin'])->group(function () {
            Route::prefix('super-admin')->group(function () {
                Route::get('/profile', [SuperAdminProfileController::class, 'profile'])->name('superadmin.profile');
                Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('superadmin.index');
                Route::resource('/dashboard/data-master/umkm', StoreController::class)->names('superadmin.data-master.umkm');
                Route::resource('/dashboard/data-master/customer', SuperAdminCustomerController::class)->names('superadmin.data-master.customer');
                Route::resource('/dashboard/data-master/category', CategoryController::class)->names('superadmin.data-master.category');
            });
        });
    });
});

require __DIR__ . '/jetstream.php';
