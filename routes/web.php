<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\WishlistController;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/matches', [MatchController::class, 'index'])->name('matches');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');

Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

    Route::get('/register', [RegistrationController::class, 'show'])->name('register');
    Route::post('/register/step-1', [RegistrationController::class, 'storeStepOne'])->name('register.step1');
    Route::post('/register/step-2', [RegistrationController::class, 'storeStepTwo'])->name('register.step2');
    Route::post('/register/complete', [RegistrationController::class, 'complete'])->name('register.complete');
});

Route::middleware(Authenticate::class)->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{profileId}', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{profileId}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});

Route::get('/privacy-policy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/terms-and-conditions', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile');
