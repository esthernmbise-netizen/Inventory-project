<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Display the login page
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Process login credentials
  

public function login(\Illuminate\Http\Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (!auth()->attempt($credentials)) {
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    $request->session()->regenerate();

    $user = $request->user();

    // Block access until the email is verified.
    if (!$user->hasVerifiedEmail()) {
        try {
            $user->sendEmailVerificationNotification();

            return redirect()->route('verification.notice')
                ->with(
                    'success',
                    'Your email is not verified. A verification email has been requested. Check your inbox and spam folder.'
                );
        } catch (\Throwable $exception) {
            report($exception);

            return redirect()->route('verification.notice')
                ->withErrors([
                    'email' => 'Your email is not verified, and the verification message could not be sent. Please check the mail configuration.',
                ]);
        }
    }

    // Direct verified Super Admin to the correct dashboard.
    if ($user->role === 'super_admin') {
        return redirect()->route('superadmin.dashboard');
    }

    // Direct other verified users to their shop dashboard.
    return redirect()->route('dashboard');
}


    // Log out the authenticated user
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'You have been logged out successfully.');
    }
}