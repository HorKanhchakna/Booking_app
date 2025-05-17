<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create()
    {
        return view('booking');
    }

    public function store(Request $request)
    {
        // You can add validation here
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'destination' => 'required|string',
            'date' => 'required|date',
        ]);

        // Normally you would save to the database, e.g.:
        // Booking::create($validated);

        return redirect()->route('booking')->with('success', 'Booking submitted successfully!');
    }
    public function submit(Request $request)
{
    // Handle booking logic here, e.g., save to DB, send email, etc.
    return back()->with('success', 'Booking submitted successfully!');
}
}

