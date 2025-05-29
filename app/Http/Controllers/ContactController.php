<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Show the contact form
    public function create()
    {
        return view('contact');
    }

    // Store the contact form submission
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->only(['name', 'email', 'subject', 'message']));

        return redirect()->back()->with('success', 'Your message has been sent!');
    }
}
