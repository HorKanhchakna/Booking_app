<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Package;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    public function index()
    {
        // Fetch data from database
        $destinations = Destination::all();
        $packages = Package::all();
        $bookings = Booking::all();

        // Pass data to the view
        // return view('Admin.dashboard', compact('destinations', 'packages', 'bookings'));
    }

    public function dashboard()
    {
        $destinations = Destination::all();
        $packages = Package::all();
        $bookings = Booking::with('package')->get();
        return view('Admin.dashboard', compact('destinations', 'packages', 'bookings'));
    }
}
