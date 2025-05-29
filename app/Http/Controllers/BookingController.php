<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Show the booking form
    public function index()
    {
        $packages = Package::all(); // Get all packages from the DB
        return view('booking', compact('packages')); // Pass to the view
    }

    public function create()
    {
        $packages = Package::all();
        return view('booking', compact('packages'));
    }

    // Handle booking form submission
    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'notes' => 'nullable|string',
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'name' => Auth::user()->name, // use auth user data here
            'email' => Auth::user()->email,
            'package_id' => $validated['package_id'],
            'booking_date' => $validated['booking_date'],
            'notes' => $validated['notes'],
        ]);

        return back()->with('success', 'Booking created successfully!');
    }

    // Delete booking (cancel)
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        // Check ownership
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->delete();

        return back()->with('success', 'Booking cancelled successfully!');
    }

    // Optional: View single booking details for modal or API
    public function show($id)
    {
        $booking = Booking::with('package')->findOrFail($id);

        // Check ownership
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        return response()->json($booking);
    }
}
