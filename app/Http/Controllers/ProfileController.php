<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage; // Import Storage facade
use Illuminate\Validation\ValidationException; // Import ValidationException

// Import your models
use App\Models\User;
use App\Models\Booking;
use App\Models\Testimonial;
use App\Models\Package;

class ProfileController extends Controller
{
    /**
     * Display the user's profile dashboard with associated data.
     * Combines logic from both original 'index' and 'show' methods.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        // Eager load relationships for efficiency if used frequently
        // $user->load('bookings.package'); // Example if Booking has a 'package' relationship

        // Get all bookings of the user, ordered by latest
        $bookings = $user->bookings()->latest()->get();

        // Get IDs of packages the user has booked
        $bookedPackageIds = $bookings->pluck('package_id')->unique(); // Use unique to avoid duplicate IDs

        // Get actual Package models related to user's bookings
        $bookedPackages = Package::whereIn('id', $bookedPackageIds)->get();

        // All packages (consider if this is always needed on profile page)
        $packages = Package::all();

        // All testimonials (consider if filtering by user or status is needed)
        $testimonials = Testimonial::all();

        return view('profile.index', compact('user', 'bookings', 'testimonials', 'packages', 'bookedPackages'));
    }

    /**
     * Update the user's general profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id, // Exclude current user's email
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validatedData);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Update the user's profile picture (avatar).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
public function updateProfilePicture(Request $request)
{
    $request->validate([
        'avatar' => 'required|image|mimes:jpeg,png|max:2048',
    ]);

     $user = Auth::user();
    if ($request->hasFile('avatar')) {
        // ✅ Delete old picture only if new one is uploaded
        if ($user->profile_picture) {
            \Storage::disk('public')->delete($user->profile_picture);
        }

        // ✅ Save new picture
        $path = $request->file('avatar')->store('profile_pictures', 'public');

        // ✅ Update database
        $user->profile_picture = $path;
        $user->save();
    }

    return back()->with('success', 'Profile picture updated!');
}


    /**
     * Change the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'string', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('The provided current password does not match your actual password.');
                }
            }],
            // Password::defaults() applies default rules (min 8 chars, mixed case, numbers, symbols)
            'new_password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user->forceFill([
            'password' => Hash::make($request->new_password),
        ])->save();

        // Consider logging out the user or requiring re-authentication after password change for security
        // Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }
}
