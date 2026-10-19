<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\EmailAccessVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class LoginController extends Controller
{
    /**
     * Display the login page.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Authenticate the user and require confirmation for this login.
     */
    public function login(
        Request $request,
        EmailAccessVerification $verification
    ) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check the user's credentials.
        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ])
                ->onlyInput('email');
        }

        // Protect the authenticated session.
        $request->session()->regenerate();

        // Every login must have a fresh email confirmation.
        $request->session()->forget('email_access_challenge_id');

        try {
            // Send a new confirmation link for this login.
            $challengeId = $verification->send($request->user());

            // Bind the confirmation challenge to this session.
            $request->session()->put(
                'email_access_challenge_id',
                $challengeId
            );

            return redirect()
                ->route('verification.notice')
                ->with(
                    'success',
                    'A new login confirmation link has been sent to your email. Open the link to continue.'
                );

        } catch (Throwable $exception) {
            // Log the technical error without exposing it to the user.
            report($exception);

            return redirect()
                ->route('verification.notice')
                ->withErrors([
                    'email' => 'We could not send your login confirmation email. Please try resending it or check the mail configuration.',
                ]);
        }
    }

    /**
     * Log out the authenticated user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'You have been logged out successfully.');
    }
}
