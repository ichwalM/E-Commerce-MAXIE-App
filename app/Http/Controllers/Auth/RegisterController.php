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

        $user = $action->execute($request->all());

        if ($user->is_active) {
            Auth::login($user);
            return redirect()->intended('dashboard');
        }

        return redirect()->route('login')->with('success', 'Registration successful. Please wait for admin approval.');
    }
}
