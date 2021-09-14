<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('v1')->group(function () {
    Route::get('products/search', ['App\Http\Controllers\Api\ProductController', 'search'])->name('products.search');
    Route::resource('products', 'App\Http\Controllers\Api\ProductController')->only(['index', 'show']);
    Route::resource('pharmacies', 'App\Http\Controllers\Api\PharmacyController')->only(['index', 'show']);
});