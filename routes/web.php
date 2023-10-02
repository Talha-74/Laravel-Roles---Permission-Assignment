<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ServiceProviderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Create Shop routes
Route::get('/shops/create', [ShopController::class, 'index'])->name('shops.create');
Route::post('/shops/store', [ShopController::class, 'createShop'])->name('shops.store');

// Create Service Provider routes
Route::get('/serviceProviders/create', [ServiceProviderController::class, 'index'])->name('serviceProviders.create');
Route::post('/serviceProviders/store', [ServiceProviderController::class, 'store'])->name('serviceProviders.store');

// Login as shop
Route::get('/shops/login', [ShopController::class, 'login_index'])->name('shops.login');

// login as service provider
Route::get('/serviceProviders/login', [ServiceProviderController::class, 'login_index'])->name('serviceProviders.login');

// Shop Dishboard
Route::get('/shops/dashboard', [ShopController::class, 'dashboard_index'])->name('shops.dashboard');
Route::post('/shops/dashboard/store', [ShopController::class, 'login_shop'])->name('shops.dashboard-store');

// Service Provider Dashboard
Route::get('/serviceProviders/dashboard', [ServiceProviderController::class, 'dashboard_index'])->name('serviceProviders.dashboard');
Route::post('/serviceProviders/dashboard-login', [ServiceProviderController::class, 'login_serviceProvider'])->name('serviceProviders.dashboard-login');

// Add products to shop
Route::get('/shops/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/shops/products/store', [ProductController::class, 'store'])->name('products.store');

// Add services
Route::get('/ServiceProviders/services/create', [ServiceController::class, 'create'])->name('services.create');
Route::post('/ServiceProviders/services/store', [ServiceController::class, 'store'])->name('services.store');

// Displaying created shops
Route::get('/display/shops', [ShopController::class, 'display'])->name('display');