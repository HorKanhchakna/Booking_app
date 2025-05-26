<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\Tour;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    // List all testimonials
    public function index()
    {
        // You may want to eager load user and tour for efficiency
        $testimonials = Testimonial::with(['user', 'tour'])->get();
        return view('testimonials.index', compact('testimonials'));
    }

    // Show form to create a testimonial
    public function create()
    {
        // You may need list of tours to select from
        $tours = Tour::all();
        return view('testimonials.create', compact('tours'));
    }

    // Store a new testimonial
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',    // user must exist
            'tour_id' => 'required|exists:tours,id',    // tour must exist
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        Testimonial::create($request->all());

        return redirect()->route('testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    // Show one testimonial
    public function show(Testimonial $testimonial)
    {
        return view('testimonials.show', compact('testimonial'));
    }

    // Show form to edit a testimonial
    public function edit(Testimonial $testimonial)
    {
        $tours = Tour::all();
        return view('testimonials.edit', compact('testimonial', 'tours'));
    }

    // Update a testimonial
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'tour_id' => 'required|exists:tours,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        $testimonial->update($request->all());

        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    // Delete a testimonial
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
