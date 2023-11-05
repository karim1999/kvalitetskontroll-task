<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->prefix('admin')->group(function () {

    Route::post('/login', [AdminController::class, 'login'])->name('login');

    Route::middleware('admin')->group(function () {
        Route::get('/user', [AdminController::class, 'getUser'])->name('get');
        Route::resource('orders', OrderController::class)->only(['index', 'show']);
        Route::resource('products', ProductController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});
