<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::resource('products', ProductController::class);
});
