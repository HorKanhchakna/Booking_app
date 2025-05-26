<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Make sure this is imported if you are using the User model
use Illuminate\Support\Facades\Hash; // Make sure this is imported for password hashing
use Illuminate\Support\Facades\Session; // Import Session facade (optional, but good practice if you use Session facade directly)

class AuthController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); // Auto login after register
        return redirect()->route('home'); // Redirect to home page after registration
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home')); // Redirect to home page after login
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Log out the user

        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        // Redirect to the login page with a success message (optional)
        return redirect()->route('login')->with('status', 'You have been logged out.');
    }

    // Assuming this profile method is part of AuthController for demonstration,
    // but typically it would be in ProfileController as per your web.php
    public function profile()
    {
       $user = Auth::user();
       return view('profile.index', compact('user'));
    }
}
