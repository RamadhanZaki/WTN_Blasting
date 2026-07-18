<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LandingSettingController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public routes (Landing Page)
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing.index');

// Order dari customer
Route::get('/order', [OrderController::class, 'create'])->name('order.create');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

// Tracking order
Route::get('/tracking', [OrderController::class, 'trackForm'])->name('order.track.form');
Route::post('/tracking', [OrderController::class, 'trackSubmit'])->name('order.track.submit');
Route::get('/tracking/{orderCode}', [OrderController::class, 'trackShow'])->name('order.track.show');

/*
|--------------------------------------------------------------------------
| Auth routes untuk admin (pakai Laravel Breeze/UI bawaan, silakan sesuaikan)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php'; // dari Laravel Breeze, generate dengan: php artisan breeze:install blade

/*
|--------------------------------------------------------------------------
| Admin routes (butuh login + role admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Orderan / Antrean
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/acc', [AdminOrderController::class, 'updateAcc'])->name('orders.acc');
    Route::patch('/orders/{order}/stage', [AdminOrderController::class, 'updateStage'])->name('orders.stage');
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

    // Produk (CRUD)
    Route::resource('products', AdminProductController::class)->except(['show']);

    // Testimoni (CRUD)
    Route::resource('testimonials', AdminTestimonialController::class)->except(['show']);

    // Edit Landing Page
    Route::get('/landing', [LandingSettingController::class, 'edit'])->name('landing.edit');
    Route::post('/landing', [LandingSettingController::class, 'update'])->name('landing.update');
});
