<?php

use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['auth:api'])->group(function () {
    
    Route::apiResource('order', OrderController::class);

    Route::get('search', [OrderController::class, 'search']);

    Route::get('customer', [CustomerController::class, 'index']);

    Route::get('product', [ProductController::class, 'index']);

});


