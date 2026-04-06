<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/matches', function () {
    return view('pages.matches');
})->name('matches');

Route::get('/plans', function () {
    return view('pages.plans');
})->name('plans');

Route::get('/success-stories', function () {
    return view('pages.success');
})->name('success');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');

Route::get('/blog', function () {
    return view('pages.blog');
})->name('blog');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/register', function () {
    return view('pages.register');
})->name('register');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

Route::get('/privacy-policy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/terms-and-conditions', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/profile/{id}', function (int $id) {
    $demoProfiles = [
        101 => [
            'name' => 'Aanya Sharma',
            'age' => 27,
            'location' => 'Pune',
            'profession' => 'Product Designer',
            'about' => 'Creative and family-oriented professional who values honesty, balance, and growth. Looking for a kind and ambitious life partner.',
            'height' => '5ft 4in',
            'religion' => 'Hindu',
            'language' => 'Hindi',
            'education' => 'B.Des',
            'income' => 'INR 14 LPA',
        ],
        201 => [
            'name' => 'Ishita Nair',
            'age' => 27,
            'location' => 'Kochi',
            'profession' => 'Financial Analyst',
            'about' => 'A grounded and ambitious individual who enjoys travel, books, and meaningful conversations.',
            'height' => '5ft 5in',
            'religion' => 'Hindu',
            'language' => 'Malayalam',
            'education' => 'MBA',
            'income' => 'INR 16 LPA',
        ],
        202 => [
            'name' => 'Sarthak Jain',
            'age' => 30,
            'location' => 'Jaipur',
            'profession' => 'Chartered Accountant',
            'about' => 'Family-first professional with modern outlook and strong value system, seeking a compatible partner.',
            'height' => '5ft 9in',
            'religion' => 'Jain',
            'language' => 'Hindi',
            'education' => 'CA',
            'income' => 'INR 22 LPA',
        ],
    ];

    $profile = $demoProfiles[$id] ?? [
        'name' => 'SoulMatch Member',
        'age' => 29,
        'location' => 'Bengaluru',
        'profession' => 'Software Engineer',
        'about' => 'Warm, responsible, and growth-driven individual looking for a meaningful long-term relationship.',
        'height' => '5ft 8in',
        'religion' => 'Hindu',
        'language' => 'English',
        'education' => 'B.Tech',
        'income' => 'INR 18 LPA',
    ];

    return view('pages.profile', compact('id', 'profile'));
})->name('profile');
