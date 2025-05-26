<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Tour;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tour_id', 'rating', 'review'];


    /**
     * A testimonial belongs to a user.
     */
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
