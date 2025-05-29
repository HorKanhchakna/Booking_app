<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        // Validate form input
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Create new message
        $contactMessage = new ContactMessage($request->only('name', 'email', 'subject', 'message'));

        // If logged in, attach user_id
        if (Auth::check()) {
            $contactMessage->user_id = Auth::id();
        }

        $contactMessage->save();

        return redirect()->back()->with('success', 'Your message has been sent!');
    }
}
