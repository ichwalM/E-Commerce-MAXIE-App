<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\RegisterUserAction;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request, RegisterUserAction $action)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
            'role' => 'required|in:distributor,customer',
            'phone' => 'required_if:role,distributor',
        ]);



        // Generate OTP
        $otp = rand(100000, 999999);

        // Store in Temporary Table
        \App\Models\PendingRegistration::updateOrCreate(
            ['email' => $request->email], // Update if exists to handle resends before verification
            [
                'name' => $request->name,
                // 'email' is in search criteria
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                'role' => $request->role,
                'phone' => $request->phone,
                'address' => $request->address, // Ensure address is captured if sent
                'otp' => $otp,
                'otp_expires_at' => now()->addMinutes(15),
            ]
        );

        // Send OTP Email
        try {
            \Illuminate\Support\Facades\Mail::to($request->email)->send(new \App\Mail\OtpMail($otp));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Mail Error: ' . $e->getMessage());
        }

        return redirect()->route('verification.notice', ['email' => $request->email]);
    }

}
