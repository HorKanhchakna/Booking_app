<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    // Display a listing of tours
    public function index()
    {
        $tours = Tour::all(); // get all tours
        return view('tours.index', compact('tours'));
    }

    // Show the form for creating a new tour
    public function create()
    {
        return view('tours.create');
    }

    // Store a newly created tour in database
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        // Create tour record
        Tour::create($request->all());

        // Redirect to tours list with success message
        return redirect()->route('tours.index')->with('success', 'Tour created successfully.');
    }

    // Display a specific tour
    public function show(Tour $tour)
    {
        return view('tours.show', compact('tour'));
    }

    // Show the form for editing an existing tour
    public function edit(Tour $tour)
    {
        return view('tours.edit', compact('tour'));
    }

    // Update the specified tour in database
    public function update(Request $request, Tour $tour)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $tour->update($request->all());

        return redirect()->route('tours.index')->with('success', 'Tour updated successfully.');
    }

    // Remove the specified tour from database
    public function destroy(Tour $tour)
    {
        $tour->delete();

        return redirect()->route('tours.index')->with('success', 'Tour deleted successfully.');
    }
}
