<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'image', 'location', 'duration', 'people', 'price', 'description'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function testimonials()
{
    return $this->hasMany(Testimonial::class);
}
}
