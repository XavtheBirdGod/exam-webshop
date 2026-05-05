<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\ProductController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/shop', function () {
    return view('pages.shop');
})->name('shop');

Route::get('/collections', function () {
    return view('pages.collections');
})->name('collections');

Route::get('/sustainability', function () {
    return view('pages.sustainability');
})->name('sustainability');

Route::get('/product/{id}', function ($id) {
    return view('pages.product-detail');
})->name('product.detail');

Route::get('/cart', function () {
    return view('pages.shop'); // Placeholder for now
})->name('cart');

Route::get('/account', function () {
    return view('pages.shop'); // Placeholder for now
})->name('account');

Route::middleware(['auth', 'role:seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::resource('products', ProductController::class);
});
