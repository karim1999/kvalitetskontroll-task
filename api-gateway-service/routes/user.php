<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::name('user.')->group(function () {
    Route::post('/register', [UserController::class, 'register'])->name('register');
    Route::post('/login', [UserController::class, 'login'])->name('login');

    Route::middleware('user')->group(function () {
        Route::get('/user', [UserController::class, 'getUser'])->name('get');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
        Route::resource('orders', OrderController::class)->only(['index', 'show']);
        Route::resource('products', ProductController::class)->only(['index', 'show']);
    });
});
