<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;

// Authentication Routes
Route::middleware('guest')->group(function () {
    // Registration
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/index', function () {
        return view('index');
    })->name('index');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Public Page Routes
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services', function () {
    $services = [
        [
            'icon' => 'fa-globe',
            'title' => 'WorldWide Tours',
            'description' => 'Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam'
        ],
        [
            'icon' => 'fa-hotel',
            'title' => 'Hotel Reservation',
            'description' => 'Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam'
        ],
        [
            'icon' => 'fa-hotel',
            'title' => 'Hotel Reservation',
            'description' => 'Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam'
        ],
        [
            'icon' => 'fa-hotel',
            'title' => 'Hotel Reservation',
            'description' => 'Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam'
        ],
    ];

    $testimonials = [
        [
            'image' => 'testimonial-1.jpg',
            'name' => 'John Doe',
            'location' => 'New York, USA',
            'comment' => 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos.'
        ],
    ];

    return view('services', compact('services', 'testimonials'));
})->name('services');

Route::get('/packages', function () {
    $packages = [
        [
            'image' => 'package-1.jpg',
            'destination' => 'Thailand',
            'duration' => '3 days',
            'people' => '2 Person',
            'price' => 149.00,
            'description' => 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam eos'
        ],
        [
            'image' => 'package-2.jpg',
            'destination' => 'Indonesia',
            'duration' => '3 days',
            'people' => '2 Person',
            'price' => 139.00,
            'description' => 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam eos'
        ],
        [
            'image' => 'package-3.jpg',
            'destination' => 'Malaysia',
            'duration' => '3 days',
            'people' => '2 Person',
            'price' => 189.00,
            'description' => 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam eos'
        ]
    ];

    return view('packages', compact('packages'));
})->name('packages');

Route::get('/destination', function () {
    return view('destination');
})->name('destination');

Route::get('/booking', function () {
    return view('booking');
})->name('booking');
Route::post('/booking/submit', [BookingController::class, 'submit'])->name('booking.submit');


// Changed from 'team' to 'guides' to match your Blade template
Route::get('/team', function () {
    return view('team'); // Make sure you have team.blade.php
})->name('team');

// Changed from 'testimonial' to 'testimonials' to match your Blade template
Route::get('/testimonials', function () {
    return view('testimonials'); // Make sure you have testimonial.blade.php
})->name('testimonials');

// Added 404 route that was missing
Route::get('/404', function () {
    return view('404'); // Make sure you create 404.blade.php
})->name('not-found');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
