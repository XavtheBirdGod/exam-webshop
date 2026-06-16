<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seller\ProductController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

foreach (config('tenancy.central_domains', []) as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            $tenants = \App\Models\Tenant::with('domains')->get();
            return view('pages.home', compact('tenants'));
        })->name('home');

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

        // Auth Routes for Central Domain
        Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
        Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->middleware('guest');
        Route::match(['get', 'post'], '/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
    });
}


