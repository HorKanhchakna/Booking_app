<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    // Display all testimonials and optionally pass a testimonial for editing
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('testimonials', compact('testimonials'));
    }

    // Show testimonials on another page like services
    public function services()
    {
        $testimonials = Testimonial::all();
        return view('services', compact('testimonials'));
    }

    // Store a new testimonial
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        Testimonial::create([
            'user_id' => Auth::id(),
            'package_id' => $request->package_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial submitted successfully!');
    }

    // Show the same index view with a testimonial for editing
    public function edit($id)
    {
        $testimonials = Testimonial::all();
        $testimonial = Testimonial::findOrFail($id);
        return view('testimonials', compact('testimonials', 'testimonial'));
    }

    // Update an existing testimonial
    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        $testimonial = Testimonial::findOrFail($id);

        // Optional: check if user owns this testimonial
        if ($testimonial->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $testimonial->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    // Delete a testimonial
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($testimonial->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $testimonial->delete();

        return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted successfully!');
    }
}
