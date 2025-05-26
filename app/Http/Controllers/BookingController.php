<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // List all bookings
    public function index()
    {
        // Eager load user and tour for performance
        $bookings = Booking::with(['user', 'tour'])->get();
        return view('bookings.index', compact('bookings'));
    }

    // Show form to create a booking
    public function create()
    {
        $tours = Tour::all();
        return view('bookings.create', compact('tours'));
    }

    // Store a new booking
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tour_id' => 'required|exists:tours,id',
            'booking_date' => 'required|date',
            'number_of_people' => 'required|integer|min:1',
            'status' => 'nullable|string', // you can refine this later
        ]);

        Booking::create($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    // Show one booking
    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    // Show form to edit a booking
    public function edit(Booking $booking)
    {
        $tours = Tour::all();
        return view('bookings.edit', compact('booking', 'tours'));
    }

    // Update a booking
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tour_id' => 'required|exists:tours,id',
            'booking_date' => 'required|date',
            'number_of_people' => 'required|integer|min:1',
            'status' => 'nullable|string',
        ]);

        $booking->update($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    // Delete a booking
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
