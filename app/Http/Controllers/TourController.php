<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'duration' => 'required|string|max:50',
            'max_people' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'rating' => 'required|numeric|min:0|max:5',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('package_images', 'public');

        Tour::create([
            'title' => $validated['title'],
            'location' => $validated['location'],
            'duration' => $validated['duration'],
            'max_people' => $validated['max_people'],
            'price' => $validated['price'],
            'rating' => $validated['rating'],
            'description' => $validated['description'],
            'image_path' => $imagePath
        ]);

        return redirect()->back()->with('success', 'Tour package created successfully!');
    }
}
