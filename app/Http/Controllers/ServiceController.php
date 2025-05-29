<?php

namespace App\Http\Controllers;

use App\Models\Testimonial; // Make sure you have this model
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all(); // Or any query you need
        return view('services', compact('testimonials'));
    }
}
