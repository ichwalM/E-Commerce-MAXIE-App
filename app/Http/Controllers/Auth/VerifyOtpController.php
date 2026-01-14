<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerifyOtpController extends Controller
{
    public function show(Request $request)
    {
        return view('auth.verify-otp', ['email' => $request->query('email')]);
    }


    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:pending_registrations,email',
            'otp' => 'required|string|size:6',
        ]);

        $pendingUser = \App\Models\PendingRegistration::where('email', $request->email)->first();

        if (!$pendingUser->otp || (string)$pendingUser->otp !== (string)$request->otp) {
            return back()->with('error', 'Invalid OTP code.');
        }

        if ($pendingUser->otp_expires_at && now()->greaterThan($pendingUser->otp_expires_at)) {
            return back()->with('error', 'OTP has expired. Please request a new one.');
        }

        // Verify Success - Move to Real Users Table
        $user = \Illuminate\Support\Facades\DB::transaction(function () use ($pendingUser) {
            $newUser = \App\Models\User::create([
                'name' => $pendingUser->name,
                'email' => $pendingUser->email,
                'password' => $pendingUser->password, // Already hashed
                'role' => $pendingUser->role,
                'is_active' => $pendingUser->role === 'customer',
                'email_verified_at' => now(),
            ]);

            if ($pendingUser->role === 'distributor') {
                \App\Models\DistributorProfile::create([
                    'user_id' => $newUser->id,
                    'phone' => $pendingUser->phone,
                    'address' => $pendingUser->address,
                ]);
            }

            $pendingUser->delete();
            return $newUser;
        });

        \Illuminate\Support\Facades\Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function resend(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:pending_registrations,email']);
        $pendingUser = \App\Models\PendingRegistration::where('email', $request->email)->first();

        // Generate new OTP
        $otp = rand(100000, 999999);
        $pendingUser->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(15),
        ]);

        \Illuminate\Support\Facades\Mail::to($pendingUser->email)->send(new \App\Mail\OtpMail($otp));

        return back()->with('success', 'New OTP sent to your email.');
    }
}
