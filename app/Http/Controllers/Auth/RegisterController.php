<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EmailAccessVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(
        Request $request,
        EmailAccessVerification $verification
    ) {
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

        Auth::login($user);

        $request->session()->regenerate();
        $request->session()->forget('email_access_challenge_id');

        try {
            $challengeId = $verification->send($user);

            $request->session()->put(
                'email_access_challenge_id',
                $challengeId
            );
        } catch (Throwable $exception) {
            report($exception);

            return redirect()
                ->route('verification.notice')
                ->withErrors([
                    'email' => 'Your account was created, but the confirmation email could not be sent. Please use the resend button.',
                ]);
        }

        return redirect()
            ->route('verification.notice')
            ->with(
                'success',
                'Your account was created. Open the login confirmation link sent to your email to continue.'
            );
    }
}
