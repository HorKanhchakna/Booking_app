<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ContactMessageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [PackageController::class, 'index'])->name('home');

Route::get('/packages', [PackageController::class, 'packages'])->name('packages');
Route::get('/destination', [DestinationController::class, 'index'])->name('destination');

Route::view('/about', 'about')->name('about');
Route::view('/services', 'services')->name('services'); // Correct static services route
Route::get('/services', [App\Http\Controllers\ServiceController::class, 'index'])->name('services');

Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');
Route::view('/team', 'team')->name('team');

// Guest-only Routes (login/register)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::match(['post', 'put'], 'profile/update', [ProfileController::class, 'update']);
    Route::post('/profile/password/change', [ProfileController::class, 'changePassword'])->name('profile.password.change');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

    // Booking routes
    Route::get('/booking', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('bookings.store');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin routes
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
// Handle booking cancellation via POST
Route::post('/bookings/{id}/cancel', [BookingController::class, 'destroy'])->name('booking.cancel');

Route::post('/user/profile-picture/update', [ProfileController::class, 'updateProfilePicture'])->name('user.profile_picture.update');

Route::resource('testimonials', TestimonialController::class);
Route::resource('testimonials', TestimonialController::class)->except(['edit', 'update', 'destroy']);


