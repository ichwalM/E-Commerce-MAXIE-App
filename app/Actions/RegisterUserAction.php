<?php

namespace App\Actions;

use App\Models\User;
use App\Models\DistributorProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterUserAction
{
    public function execute(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
                'is_active' => $data['role'] === 'customer', // Distributors need approval
            ]);

            if ($data['role'] === 'distributor') {
                DistributorProfile::create([
                    'user_id' => $user->id,
                    'phone' => $data['phone'] ?? null,
                    'address' => $data['address'] ?? null,
                ]);
            }

            return $user;
        });
    }
}
