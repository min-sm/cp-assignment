<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StripePaymentController;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Products\Create;
use App\Livewire\Admin\Products\Edit;
use App\Livewire\Admin\Products\Index;
use App\Livewire\Admin\Products\Show;
use App\Models\Product;
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
    Route::post('/checkout/process', [OrderController::class, 'process'])->name('checkout.process');
    Route::get('/history', [OrderController::class, 'history'])->name('history');
    Route::post('/inquiry', [InquiryController::class, 'create'])->name('inquiry.submit');
});

Route::get('/cart', fn() => view('pages.cart'))->name('cart');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::post('/products', [ProductController::class, 'filter'])->name('products.filter');
Route::get('/about-us', fn() => view('pages.about'))->name('about');

Route::get('/inquiry', [InquiryController::class, 'index'])->name('inquiry');

Route::fallback(function () {
    return view('errors.404');
});

Route::prefix('admin')->group(function () {
    // Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', Dashboard::class)->name('admin.dashboard');
    Route::prefix('products')->group(function () {
        Route::get('/', Index::class)->name('admin.products.index');
        Route::get('/create', Create::class)->name('admin.products.create');
        Route::post('/', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/{slug}', Show::class)->name('admin.products.show');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('admin.products.delete');
        Route::get('/{slug}/edit', Edit::class)->name('admin.products.edit');
        Route::put('/{slug}', [ProductController::class, 'update'])->name('admin.products.update');
    });
});

Route::get('/test', function () {
    return view('pages.test');
})->name('test');

Route::controller(StripePaymentController::class)->group(function () {
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});
