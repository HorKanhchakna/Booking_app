<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tour_id', 'booking_date', 'number_of_people', 'total_price'];

   // Define the inverse relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship to the Tour model (assuming you have one)
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
