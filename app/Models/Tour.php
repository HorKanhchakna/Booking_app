<?php
// app/Models/Tour.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = ['name', 'description', 'price']; // add your fields

 // If a tour can have many bookings:
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // If a tour can have many testimonials:
    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
}
