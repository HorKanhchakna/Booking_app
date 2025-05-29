<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Image uploaded successfully!');
    }

    public function index() {
        $galleries = Gallery::all();
        return view('partials.footer', compact('galleries'));
    }

}
