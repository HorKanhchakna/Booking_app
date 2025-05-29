<?php
// app/Models/Tour.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    // Explicitly define the correct table name
    protected $table = 'tour_packages';

    protected $fillable = [
        'title',
        'location',
        'duration',
        'max_people',
        'price',
        'rating',
        'description',
        'image_path'
    ];
}