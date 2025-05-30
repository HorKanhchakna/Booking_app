<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'discount' => 'required|numeric',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                "description" => 'required|string|max:1000',
            ]);


            $imagePath = $this->storeImageAndGetUrl($request)[1];

            $destination = new Destination();
            $destination->name = $request->name;
            $destination->image = $imagePath;
            $destination->discount = $request->discount;
            $destination->description = $request->description;
            $destination->save();


            return redirect()->route('admin.dashboard')->with('success', 'Destination added successfully!');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
    public function index()
    {
        // Fetch all destinations from the database
        $destinations = Destination::all();

        // Pass $destinations to the view named 'destination'
        return view('destination', compact('destinations'));
    }
    public function storeImageAndGetUrl(Request $request)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('img', 'public'); // storage/app/public/uploads/...

            $url = asset('storage/' . $path); // Converts to public URL

            return [
                $path,
                $url,
            ];
        }

        return response()->json(['error' => 'Invalid image file'], 400);
    }
}
