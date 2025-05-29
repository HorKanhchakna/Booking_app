<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
        'profile_picture', // if used
        'avatar_url',      // if used
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
     */
   // User.php

public function testimonials()
{
    return $this->hasMany(Testimonial::class);
}

public function bookings()
{
    return $this->hasMany(Booking::class);
}

    /**
     * Get the packages booked by the user through bookings.
     */
    public function bookedPackages()
    {
        // hasManyThrough(target, through, firstKeyOnThrough, secondKeyOnTarget, localKey, secondLocalKey)
        // In your case:
        // - User hasMany Bookings (user_id on bookings)
        // - Booking belongsTo Package (package_id on bookings)
        // So get Packages through Bookings
        return $this->hasManyThrough(
            Package::class,    // final target model
            Booking::class,    // intermediate model
            'user_id',         // Foreign key on bookings table (relates to users.id)
            'id',              // Foreign key on packages table (relates to bookings.package_id)
            'id',              // Local key on users table
            'package_id'       // Local key on bookings table
        );
    }
}
