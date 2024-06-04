<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class);
Route::post('api/fetch-states', [ProductController::class, 'fetchState']);
Route::post('api/fetch-cities', [ProductController::class, 'fetchCity']);