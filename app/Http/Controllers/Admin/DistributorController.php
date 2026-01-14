<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class DistributorController extends Controller
{
    public function index()
    {
        $distributors = User::where('role', 'distributor')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.distributors.index', compact('distributors'));
    }

    public function approve(User $user)
    {
        if ($user->role !== 'distributor') {
            abort(403);
        }

        $user->update(['is_active' => true]);

        return back()->with('success', 'Distributor approved successfully.');
    }
}
