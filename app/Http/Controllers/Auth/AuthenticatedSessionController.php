<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->validateCredentials();

        $user = \App\Models\User::where('email', $request->email)->first();
        
        // Generate OTP
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        // Send Email
        \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\LoginOtpMail($otp));

        // Store email in session for OTP verification step
        session(['login_email' => $request->email, 'login_remember' => $request->boolean('remember')]);

        return redirect()->route('verify-otp');
    }

    public function showVerifyOtp(): View
    {
        if (!session('login_email')) return redirect()->route('login');
        return view('auth.verify-otp');
    }

    public function loginWithOtp(Request $request): RedirectResponse
    {
        $request->validate(['otp' => 'required|string']);
        
        $email = session('login_email');
        if (!$email) return redirect()->route('login');

        $user = \App\Models\User::where('email', $email)->first();

        if ($user && $user->otp === $request->otp && now()->isBefore($user->otp_expires_at)) {
            // Clear OTP
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            // Log in the user
            Auth::login($user, session('login_remember', false));
            session()->forget(['login_email', 'login_remember']);
            session()->regenerate();

            return redirect()->intended(route('dashboard', absolute: false));
        }

        return back()->withErrors(['otp' => 'The provided OTP is invalid or has expired.']);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
