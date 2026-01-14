<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\DistributorProfile;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'nik' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
        ]);

        $user->update([
            'name' => $request->name,
        ]);

        if ($user->role === 'distributor') {
            DistributorProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'nik' => $request->nik,
                    'birth_date' => $request->birth_date,
                ]
            );
        }

        return back()->with('success', 'Profile updated successfully.');
    }
}
