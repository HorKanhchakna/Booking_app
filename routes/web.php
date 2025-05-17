<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Register Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Index Route (After login/register)
Route::get('/index', function () {
    return view('index');
})->middleware('auth')->name('index');


// Main Homepage Route
Route::get('/', function () {
    return view('index');
})->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/packages', function () {
    return view('packages');
})->name('packages');

Route::get('/destination', function () {
    return view('destination');
})->name('destination');

Route::get('/booking', function () {
    return view('booking');
})->name('booking');

Route::get('/team', function () {
    return view('team');
})->name('team');

Route::get('/testimonial', function () {
    return view('testimonial');
})->name('testimonial');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/register', function () {
    return view('register');
})->name('register');;


// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
