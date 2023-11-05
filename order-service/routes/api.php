<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::resource('orders', \App\Http\Controllers\OrderController::class)->only(['index', 'show']);
Route::post('/orders/{order}/submit', [\App\Http\Controllers\OrderController::class, 'submit'])->name('orders.submit');
Route::post('/add-to-cart', [\App\Http\Controllers\OrderController::class, 'addToCart'])->name('add-to-cart');
