<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\Booking;
use App\Models\Testimonial;
use App\Models\Tour; // <--- ADD THIS LINE to import the Tour model

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validatedData);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function show()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $bookings = $user->bookings()->with('tour')->paginate(10, ['*'], 'bookingsPage');
        $testimonials = $user->testimonials()->with('tour')->paginate(10, ['*'], 'testimonialsPage');

        // <--- ADD THESE LINES to fetch tours and pass them to the view
        $availableTours = Tour::all(); // Fetch all tours
        // You might want to filter this later, e.g., only tours the user has booked.
        // For now, fetching all tours is a simple solution.

        return view('profile.index', compact('user', 'bookings', 'testimonials', 'availableTours')); // <--- Pass $availableTours
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $avatarName = time() . '.' . $request->avatar->extension();
        $request->avatar->move(public_path('avatars'), $avatarName);

        $user->avatar_url = 'avatars/' . $avatarName;
        $user->save();

        return back()->with('success', 'Avatar updated successfully.');
    }

    public function changePassword(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'string', function ($attribute, $value, $fail) use ($user) {
                if (! Hash::check($value, $user->password)) {
                    $fail('The provided current password does not match your actual password.');
                }
            }],
            'new_password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->forceFill([
            'password' => Hash::make($request->new_password),
        ])->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }

   
}
