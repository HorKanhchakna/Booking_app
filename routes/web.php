<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TourController;


// Routes for authenticated users only
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');  // Single profile route for authenticated users

    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password/change', [ProfileController::class, 'changePassword'])->name('profile.password.change');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

    Route::post('/testimonial/store', [TestimonialController::class, 'store'])->name('testimonial.store');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');  // Put logout here
});


// Guest-only routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    // ADDED NAME TO THE LOGIN POST ROUTE
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    // If you prefer, you could also name it 'login.post' or 'login.attempt'

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Public routes without auth restriction
Route::get('/', function () { return view('home'); })->name('home');
Route::get('/about', function () { return view('about'); })->name('about');
// Route::get('/services', function () { return view('services'); })->name('service');
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::get('/packages', function () { return view('packages'); })->name('packages');
Route::get('/booking', function () { return view('booking'); })->name('booking');
Route::get('/destination', function () { return view('destination'); })->name('destination');
Route::get('/testimonials', function () { return view('testimonials'); })->name('testimonials');
Route::get('/team', function () { return view('team'); })->name('team');

// Contact Routes
Route::get('/contact', [
    ContactController::class, 'create'
])->name('contact');
Route::post('/contacts', [
    ContactController::class, 'store'
])->name('contacts.store');

// Services Route
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/destinations', [DestinationController::class, 'index'])->name('destination');

Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

Route::get('/gallery', [GalleryController::class, 'galley.store'])->name('gallery.store');

Route::resource('tours', TourController::class);
