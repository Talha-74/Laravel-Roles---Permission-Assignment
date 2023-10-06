<?php

use App\Http\Controllers\BookServiceController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'customer'], function () {
Route::post('register', [CustomerAuthController::class, 'register']);
Route::post('login', [CustomerAuthController::class, 'login']);
});

Route::get('public-data', [PublicApiController::class, 'getAllData']);

Route::middleware('auth:api')->group(function (){
Route::post('orders', [OrderController::class, 'placeOrder']);
Route::get('get-orders', [OrderController::class, 'getOrders']);
Route::get('specific-order/{id}', [OrderController::class, 'getSpecificOrder']);
});

Route::middleware('auth:api')->group(function () {
Route::post('book-service', [BookServiceController::class, 'bookService']);
Route::get('services-history', [BookServiceController::class, 'getServiceHistory']);
Route::get('service/{id}', [BookServiceController::class, 'getServiceDetails']);
});