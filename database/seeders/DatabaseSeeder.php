<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\DistributorProfile;
use App\Models\DistributorStock;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@maxie.id'],
            [
                'name' => 'Admin Maxie',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        // 2. Create Products
        $p1 = Product::create([
            'name' => 'Maxie Glow Serum',
            'slug' => 'maxie-glow-serum',
            'description' => 'Brightening serum with Niacinamide.',
            'price_admin' => 50000,
            'price_retail' => 85000,
            'is_active' => true,
        ]);
        ProductStock::create(['product_id' => $p1->id, 'quantity' => 1000]);

        $p2 = Product::create([
            'name' => 'Maxie Day Cream',
            'slug' => 'maxie-day-cream',
            'description' => 'Daily protection and moisture.',
            'price_admin' => 40000,
            'price_retail' => 75000,
            'is_active' => true,
        ]);
        ProductStock::create(['product_id' => $p2->id, 'quantity' => 1000]);

        // 3. Create Distributor
        $distributor = User::firstOrCreate(
            ['email' => 'distributor@maxie.id'],
            [
                'name' => 'Distributor 1',
                'password' => Hash::make('password'),
                'role' => 'distributor',
                'is_active' => true, // Auto active for testing
            ]
        );
        DistributorProfile::create([
            'user_id' => $distributor->id,
            'nik' => '1234567890123456',
            'phone' => '081234567890',
            'address' => 'Jakarta, Indonesia',
        ]);
        // Give distributor some stock (simulated past purchase)
        DistributorStock::create([
            'user_id' => $distributor->id,
            'product_id' => $p1->id,
            'quantity' => 10,
            'price_selling' => 85000,
        ]);

        // 4. Create Customer
        User::firstOrCreate(
            ['email' => 'customer@maxie.id'],
            [
                'name' => 'Customer 1',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'is_active' => true,
            ]
        );
    }
}
