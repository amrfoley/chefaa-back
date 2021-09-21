<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function () {
    Route::get('', ['App\Http\Controllers\HomeController', 'index'])->name('home');
    Route::get('products/search', ['App\Http\Controllers\ProductController', 'search'])->name('products.search');
    Route::get('products/ajaxSearch', ['App\Http\Controllers\ProductController', 'ajaxSearch'])->name('products.ajaxSearch');
    Route::resource('products', 'App\Http\Controllers\ProductController');
    Route::resource('pharmacies', 'App\Http\Controllers\PharmacyController');
    Route::resource('pharmacy.product', 'App\Http\Controllers\PharmacyProductController')->except(['index', 'show']);
});