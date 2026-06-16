<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return redirect()->route('shop');
    })->name('home');

    Route::get('/shop', [\App\Http\Controllers\ShopController::class, 'index'])->name('shop');
    Route::get('/collections', [\App\Http\Controllers\ShopController::class, 'collections'])->name('collections');
    Route::get('/product/{id}', [\App\Http\Controllers\ShopController::class, 'show'])->name('product.detail');
    Route::get('/sustainability', function () {
        return view('pages.sustainability');
    })->name('sustainability');

    // Static Pages
    Route::get('/contact', function () { return view('pages.contact'); })->name('contact');
    Route::get('/careers', function () { return view('pages.careers'); })->name('careers');
    Route::get('/careers/{slug}', function ($slug) {
        $jobs = [
            'retail-excellence-manager' => ['title' => 'Retail Excellence Manager', 'dept' => 'Retail', 'location' => 'Amsterdam, NL'],
            'digital-experience-designer' => ['title' => 'Digital Experience Designer', 'dept' => 'E-Commerce', 'location' => 'Amsterdam, NL'],
            'fragrance-specialist' => ['title' => 'Fragrance Specialist', 'dept' => 'Product Development', 'location' => 'Paris, FR'],
            'sustainability-lead' => ['title' => 'Sustainability Lead', 'dept' => 'Corporate Social Responsibility', 'location' => 'London, UK'],
        ];

        $job = $jobs[$slug] ?? abort(404);
        return view('pages.job-detail', compact('job'));
    })->name('careers.show');
    Route::get('/privacy', function () { return view('pages.privacy'); })->name('privacy');
    Route::get('/terms', function () { return view('pages.terms'); })->name('terms');

    // Auth & Account
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->middleware('guest');
    Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
    Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->middleware('guest');
    Route::match(['get', 'post'], '/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('/account', function () {
        $orders = \App\Models\Order::where('user_id', auth()->id())
            ->with('items.product')
            ->latest()
            ->get();
        return view('pages.account', compact('orders'));
    })->name('account')->middleware('auth');

    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

    // Cart Routes
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/shipping', [\App\Http\Controllers\CartController::class, 'updateShipping'])->name('cart.shipping.update');
    Route::post('/cart/address', [\App\Http\Controllers\CartController::class, 'updateAddress'])->name('cart.address.update');

    // Checkout Routes
    Route::post('/checkout/payment-intent', [\App\Http\Controllers\CheckoutController::class, 'createPaymentIntent'])->name('checkout.payment-intent');
    Route::get('/checkout/success', [\App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');

    // Admin Dashboard
    Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');

    // Seller Dashboard
    Route::middleware(['auth', 'role:seller'])->prefix('seller')->name('seller.')->group(function () {
        Route::resource('products', \App\Http\Controllers\Seller\ProductController::class);
    });
});
