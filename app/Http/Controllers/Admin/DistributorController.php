<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Mail;
use App\Mail\DistributorApproved;

use App\Mail\DistributorRejected;

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

        // Send Approval Email
        try {
            Mail::to($user->email)->send(new DistributorApproved($user));
        } catch (\Exception $e) {
            // Log error but don't fail the request
            \Log::error('Failed to send distributor approval email: ' . $e->getMessage());
        }

        return back()->with('success', 'Distributor approved successfully and email sent.');
    }

    public function reject(User $user)
    {
        if ($user->role !== 'distributor') {
            abort(403);
        }

        // Send Rejection Email BEFORE deleting
        try {
            Mail::to($user->email)->send(new DistributorRejected($user));
        } catch (\Exception $e) {
            \Log::error('Failed to send distributor rejection email: ' . $e->getMessage());
        }

        // Delete the user application
        $user->delete();

        return back()->with('success', 'Distributor application rejected and removed.');
    }

    public function deactivate(User $user)
    {
        if ($user->role !== 'distributor') {
            abort(403);
        }

        $user->update(['is_active' => false]);

        return back()->with('success', 'Distributor account deactivated successfully.');
    }
}
