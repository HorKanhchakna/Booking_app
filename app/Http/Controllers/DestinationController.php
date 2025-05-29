<?php

namespace App\Http\Controllers;

use App\Models\Destination;

class DestinationController extends Controller
{
     public function index()
    {
        // Fetch all destinations from the database
        $destinations = Destination::all();

        // Pass $destinations to the view named 'destination'
        return view('destination', compact('destinations'));
    }
}
