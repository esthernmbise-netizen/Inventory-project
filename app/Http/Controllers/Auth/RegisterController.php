<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Show registration page
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Create a new account and request email verification
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Log in the new user so they can access the verification page.
        Auth::login($user);

        $request->session()->regenerate();

        // Send Laravel's email verification notification.
        event(new Registered($user));

        // Do not send an unverified user to the dashboard.
        return redirect()->route('verification.notice')
            ->with('success', 'Account created! Please verify your email before using DukaStock.');
    }
}
