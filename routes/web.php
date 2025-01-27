<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    // Sign up rotues
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Sign in routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/auth/github/redirect', function () {
        return Socialite::driver('github')->redirect();
    });

    Route::get('/auth/github/callback', [AuthController::class, 'githubCallback']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/inquiry', [InquiryController::class, 'create'])->name('inquiry.create');
});

Route::get('/cart', fn() => view('pages.cart'))->name('cart');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::post('/products', [ProductController::class, 'filter'])->name('products.filter');

Route::get('/inquiry', [InquiryController::class, 'index'])->name('inquiry');

Route::fallback(function () {
    return view('errors.404');
});

Route::get('/test', function () {
    return view('pages.test');
});
