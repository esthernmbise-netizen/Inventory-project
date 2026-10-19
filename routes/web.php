
<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdminController;
use App\Models\User;
use App\Services\EmailAccessVerification;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.submit');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register.submit');
});

/*
|--------------------------------------------------------------------------
| Per-Login Email Confirmation Link
|--------------------------------------------------------------------------
| This link can open on another device. The login challenge is approved
| for the session that initiated the login.
*/

Route::get(
    '/email/access/verify/{user}/{challenge}/{token}',
    function (
        Request $request,
        string $user,
        string $challenge,
        string $token,
        EmailAccessVerification $verification
    ) {
        $account = User::findOrFail($user);

        abort_unless(
            $verification->approveFromLink(
                $account,
                $challenge,
                $token
            ),
            403,
            'This login confirmation link is invalid, expired, or already used. Request a new link.'
        );

        // Mark email as verified the first time it is confirmed.
        if (
            !$account->hasVerifiedEmail()
            && $account->markEmailAsVerified()
        ) {
            event(new Verified($account));
        }

        $currentUser = $request->user();
        $currentChallenge = $request->session()
            ->get('email_access_challenge_id');

        // Same account and same login session: proceed to the dashboard.
        if (
            $currentUser
            && (int) $currentUser->getKey() === (int) $account->getKey()
            && is_string($currentChallenge)
            && hash_equals($currentChallenge, $challenge)
        ) {
            if ($account->role === 'super_admin') {
                return redirect()
                    ->route('superadmin.dashboard')
                    ->with('success', 'This login has been confirmed.');
            }

            return redirect()
                ->route('dashboard')
                ->with('success', 'This login has been confirmed.');
        }

        // If the link opened on another device, return instructions there.
        return response()->view('auth.email-access-confirmed');

    }
)->middleware(['signed', 'throttle:6,1'])
  ->name('email.access.verify');


/*
|--------------------------------------------------------------------------
| Compatibility With Previously Sent Laravel Verification Links
|--------------------------------------------------------------------------
*/

Route::get('/email/verify/{id}/{hash}', function (
    Request $request,
    string $id,
    string $hash,
    EmailAccessVerification $verification
) {
    $account = User::findOrFail($id);

    abort_unless(
        hash_equals(
            $hash,
            sha1($account->getEmailForVerification())
        ),
        403,
        'This email verification link is invalid.'
    );

    if (
        !$account->hasVerifiedEmail()
        && $account->markEmailAsVerified()
    ) {
        event(new Verified($account));
    }

    $currentUser = $request->user();
    $challengeId = $request->session()
        ->get('email_access_challenge_id');

    if (
        $currentUser
        && (int) $currentUser->getKey() === (int) $account->getKey()
        && is_string($challengeId)
        && $verification->approveExistingChallenge(
            $account,
            $challengeId
        )
    ) {
        if ($account->role === 'super_admin') {
            return redirect()->route('superadmin.dashboard')
                ->with('success', 'Email confirmed successfully.');
        }

        return redirect()->route('dashboard')
            ->with('success', 'Email confirmed successfully.');
    }

    return response()->view('auth.email-access-confirmed');

})->middleware(['signed', 'throttle:6,1'])
  ->name('verification.verify');


/*
|--------------------------------------------------------------------------
| Authenticated Verification Notice, Resend, and Logout
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/email/verify', function (
        Request $request,
        EmailAccessVerification $verification
    ) {
        $user = $request->user();
        $challengeId = $request->session()
            ->get('email_access_challenge_id');

        if (
            $verification->isApproved(
                $user,
                is_string($challengeId) ? $challengeId : null
            )
        ) {
            if ($user->role === 'super_admin') {
                return redirect()->route('superadmin.dashboard');
            }

            return redirect()->route('dashboard');
        }

        return view('auth.verify-email');

    })->name('verification.notice');


    Route::post('/email/verification-notification', function (
        Request $request,
        EmailAccessVerification $verification
    ) {
        $user = $request->user();
        $oldChallenge = $request->session()
            ->get('email_access_challenge_id');

        if (
            $verification->isApproved(
                $user,
                is_string($oldChallenge) ? $oldChallenge : null
            )
        ) {
            if ($user->role === 'super_admin') {
                return redirect()->route('superadmin.dashboard');
            }

            return redirect()->route('dashboard');
        }

        $request->session()->forget('email_access_challenge_id');

        try {
            $challengeId = $verification->send($user);

            $request->session()->put(
                'email_access_challenge_id',
                $challengeId
            );
        } catch (\Throwable $exception) {
            report($exception);

            return back()->withErrors([
                'email' => 'The confirmation email could not be sent. Check the mail configuration and try again.',
            ]);
        }

        return back()->with(
            'success',
            'A new login confirmation link has been sent. It expires after 15 minutes.'
        );

    })->middleware('throttle:6,1')
      ->name('verification.send');


    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});


/*
|--------------------------------------------------------------------------
| Protected Application Routes
|--------------------------------------------------------------------------
| Each login session must have its own approved email challenge.
*/

Route::middleware(['auth', 'email.access.verified'])->group(function () {

    Route::get('/superadmin', [SuperAdminController::class, 'index'])
        ->name('superadmin.dashboard');

    Route::get('/', function () {
        if (auth()->user()->role === 'super_admin') {
            return redirect()->route('superadmin.dashboard');
        }

        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('categories', CategoryController::class);

    Route::resource('products', ProductController::class);

    Route::resource('product', ProductController::class);

    Route::resource('suppliers', SupplierController::class);

    Route::resource('purchases', PurchaseController::class)
        ->only(['index', 'create', 'store', 'show']);

    Route::resource('sales', SaleController::class)
        ->only(['index', 'create', 'store', 'show']);
});
