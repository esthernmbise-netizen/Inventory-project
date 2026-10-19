<?php

namespace App\Http\Middleware;

use App\Services\EmailAccessVerification;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailAccessVerified
{
    public function __construct(
        private EmailAccessVerification $verification
    ) {
    }

    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $challengeId = $request->session()
            ->get('email_access_challenge_id');

        if (
            !$this->verification->isApproved(
                $user,
                is_string($challengeId) ? $challengeId : null
            )
        ) {
            return redirect()
                ->route('verification.notice')
                ->with(
                    'success',
                    'Please confirm this login using the link sent to your email.'
                );
        }

        return $next($request);
    }
}
