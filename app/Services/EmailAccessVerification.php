<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Throwable;

class EmailAccessVerification
{
    private const CACHE_STORE = 'file';

    private function challengeKey(string $challengeId): string
    {
        return 'dukastock:email-access:challenge:'
            . hash('sha256', $challengeId);
    }

    private function tokenKey(string $token): string
    {
        return 'dukastock:email-access:token:'
            . hash('sha256', $token);
    }

    private function challengeLifetime(): int
    {
        return max((int) config('session.lifetime', 120), 15);
    }

    /**
     * Create a separate email confirmation for this login.
     * Returns the challenge ID to bind to the current session.
     */
    public function send(User $user): string
    {
        $challengeId = Str::random(48);
        $token = Str::random(64);

        $linkExpiresAt = now()->addMinutes(15);

        $challengeKey = $this->challengeKey($challengeId);
        $tokenKey = $this->tokenKey($token);

        $cache = Cache::store(self::CACHE_STORE);

        $cache->put($challengeKey, [
            'user_id' => (int) $user->getKey(),
            'verified' => false,
        ], now()->addMinutes($this->challengeLifetime()));

        $cache->put($tokenKey, [
            'user_id' => (int) $user->getKey(),
            'challenge_id' => $challengeId,
        ], $linkExpiresAt);

        $url = URL::temporarySignedRoute(
            'email.access.verify',
            $linkExpiresAt,
            [
                'user' => $user->getKey(),
                'challenge' => $challengeId,
                'token' => $token,
            ]
        );

        try {
            Mail::raw(
                "Hello {$user->name},\n\n"
                . "A sign-in to your DukaStock account was requested.\n\n"
                . "To confirm this login, open the link below within 15 minutes:\n\n"
                . "{$url}\n\n"
                . "This confirmation link can be used only once.\n\n"
                . "If you did not request this sign-in, do not open the link.",
                function ($message) use ($user) {
                    $message->to($user->email)
                        ->subject('Confirm your DukaStock sign-in');
                }
            );
        } catch (Throwable $exception) {
            $cache->forget($challengeKey);
            $cache->forget($tokenKey);

            throw $exception;
        }

        return $challengeId;
    }

    /**
     * Consume a one-time token and approve its login challenge.
     */
    public function approveFromLink(
        User $user,
        string $challengeId,
        string $token
    ): bool {
        $cache = Cache::store(self::CACHE_STORE);

        $payload = $cache->pull($this->tokenKey($token));

        if (
            !is_array($payload)
            || (int) ($payload['user_id'] ?? 0) !== (int) $user->getKey()
            || !hash_equals(
                (string) ($payload['challenge_id'] ?? ''),
                $challengeId
            )
        ) {
            return false;
        }

        return $this->approveExistingChallenge($user, $challengeId);
    }

    /**
     * Support a previously issued Laravel verification link.
     */
    public function approveExistingChallenge(
        User $user,
        ?string $challengeId
    ): bool {
        if (!$challengeId) {
            return false;
        }

        $cache = Cache::store(self::CACHE_STORE);
        $key = $this->challengeKey($challengeId);
        $challenge = $cache->get($key);

        if (
            !is_array($challenge)
            || (int) ($challenge['user_id'] ?? 0) !== (int) $user->getKey()
        ) {
            return false;
        }

        $challenge['verified'] = true;
        $challenge['verified_at'] = now()->toIso8601String();

        $cache->put(
            $key,
            $challenge,
            now()->addMinutes($this->challengeLifetime())
        );

        return true;
    }

    /**
     * Check if the current login has been confirmed.
     */
    public function isApproved(
        User $user,
        ?string $challengeId
    ): bool {
        if (!$challengeId) {
            return false;
        }

        $challenge = Cache::store(self::CACHE_STORE)
            ->get($this->challengeKey($challengeId));

        return is_array($challenge)
            && (int) ($challenge['user_id'] ?? 0) === (int) $user->getKey()
            && ($challenge['verified'] ?? false) === true;
    }
}

