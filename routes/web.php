<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\ProductController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

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

use App\Http\Controllers\ProfileController;

Route::get('/account', function () {
    $orders = auth()->user()->orders()->with('items.product')->latest()->get();
    return view('pages.account', compact('orders'));
})->name('account')->middleware('auth');

Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::middleware(['auth', 'role:seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::resource('products', ProductController::class);
});
