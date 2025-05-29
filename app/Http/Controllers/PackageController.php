<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Destination;
use App\Models\Testimonial;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        $destinations = Destination::all();

        $bookedPackages = [];

        if (Auth::check()) {
            $userId = Auth::id();
            $bookedPackageIds = Booking::where('user_id', $userId)->pluck('package_id')->unique();
            $bookedPackages = Package::whereIn('id', $bookedPackageIds)->get();
        }

        // Load testimonials with user and package for home page
        $testimonials = Testimonial::with('user', 'package')->get();

        return view('home', compact('packages', 'destinations', 'bookedPackages', 'testimonials'));
    }

    public function packages()
    {
        $packages = Package::all();

        // You may want to load testimonials here only if packages page needs it
        $testimonials = Testimonial::with('user', 'package')->get();

        return view('packages', compact('packages', 'testimonials'));
    }

    public function create()
    {
        $userId = Auth::id();

        $bookedPackageIds = Booking::where('user_id', $userId)->pluck('package_id')->unique();

        $packages = Package::whereIn('id', $bookedPackageIds)->get();

        return view('testimonials.create', compact('packages'));
    }
}
