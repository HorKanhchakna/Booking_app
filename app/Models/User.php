<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// If you are NOT using Laravel Sanctum for API authentication, you should NOT have this line:
// use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    // If you removed HasApiTokens, ensure it's not here either:
    // use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'profile_picture', // Ensure this is in your fillable array if you're using it
        'avatar_url',      // Ensure this is in your fillable array if you're using it
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the bookings associated with the user.
     * This defines a one-to-many relationship where a User has many Bookings.
     * Ensure your 'Booking' model exists in App\Models\Booking.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Get the testimonials associated with the user.
     * This defines a one-to-many relationship where a User has many Testimonials.
     * Ensure your 'Testimonial' model exists in App\Models\Testimonial.
     */
    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
}
