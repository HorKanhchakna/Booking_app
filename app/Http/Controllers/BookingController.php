<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        
        return view('booking', compact('packages'));
    }

    public function create()
    {
        $packages = Package::all();
        $bookings = Booking::paginate(10);
        return view('booking', compact( 'packages','bookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'notes' => 'nullable|string',
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'package_id' => $validated['package_id'],
            'booking_date' => $validated['booking_date'],
            'notes' => $validated['notes'],
        ]);

        return back()->with('success', 'Booking created successfully!');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $booking->delete();
        return back()->with('success', 'Booking cancelled successfully!');
    }

    public function show($id)
    {
        $booking = Booking::with('package')->findOrFail($id);
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        return response()->json($booking);
    }

    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'approved';
        $booking->save();
        return redirect()->route('admin.dashboard')->with('success', 'Booking approved successfully!');
    }
}