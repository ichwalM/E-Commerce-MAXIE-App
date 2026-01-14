<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\DistributorProfile;
use App\Models\DistributorStock;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Maxie',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        // 2. Create Products
        $products = [];
        $productData = [
            ['name' => 'Maxie Glow Serum', 'slug' => 'maxie-glow-serum', 'admin' => 50000, 'retail' => 85000],
            ['name' => 'Maxie Day Cream', 'slug' => 'maxie-day-cream', 'admin' => 45000, 'retail' => 75000],
            ['name' => 'Maxie Night Cream', 'slug' => 'maxie-night-cream', 'admin' => 55000, 'retail' => 90000],
            ['name' => 'Maxie Facial Wash', 'slug' => 'maxie-facial-wash', 'admin' => 35000, 'retail' => 60000],
            ['name' => 'Maxie Toner', 'slug' => 'maxie-toner', 'admin' => 30000, 'retail' => 50000],
        ];

        foreach ($productData as $p) {
            $product = Product::firstOrCreate(
                ['slug' => $p['slug']],
                [
                    'name' => $p['name'],
                    'description' => 'Premium skincare product.',
                    'price_admin' => $p['admin'],
                    'price_retail' => $p['retail'],
                    'is_active' => true,
                ]
            );
            ProductStock::updateOrCreate(
                ['product_id' => $product->id],
                ['quantity' => 10000]
            );
            $products[] = $product;
        }

        // 3. Create Distributors (8)
        $distributors = [];
        for ($i = 1; $i <= 8; $i++) {
            $d = User::firstOrCreate(
                ['email' => "distributor$i@example.com"],
                [
                    'name' => "Distributor $i",
                    'password' => Hash::make('password'),
                    'role' => 'distributor',
                    'is_active' => true,
                ]
            );
            DistributorProfile::firstOrCreate(
                ['user_id' => $d->id],
                [
                    'nik' => '123456789012345' . $i,
                    'phone' => '08123456789' . $i,
                    'address' => 'Jakarta, Indonesia',
                ]
            );
            $distributors[] = $d;

            // Seed initial stock
            foreach ($products as $prod) {
                // Remove existing stock first to ensure clean state if re-seeding without fresh
                DistributorStock::where('user_id', $d->id)->where('product_id', $prod->id)->delete();
                
                DistributorStock::create([
                    'user_id' => $d->id,
                    'product_id' => $prod->id,
                    'quantity' => rand(50, 200),
                    'price_selling' => $prod->price_retail
                ]);
            }
        }

        // 4. Create Customers (25)
        $customers = [];
        for ($i = 1; $i <= 25; $i++) {
            $c = User::firstOrCreate(
                ['email' => "customer$i@example.com"],
                [
                    'name' => "Customer $i",
                    'password' => Hash::make('password'),
                    'role' => 'customer',
                    'is_active' => true,
                ]
            );
            $customers[] = $c;
        }

        // 5. Generate Historical Data (Last 5 Months)
        $months = [4, 3, 2, 1, 0]; // 0 is current month

        foreach ($months as $monthsAgo) {
            $baseDate = Carbon::now()->subMonths($monthsAgo);
            $growthFactor = 1 + ((4 - $monthsAgo) * 0.3); // 30% month-over-month growth roughly

            // A. Restock Orders (Admin Revenue)
            foreach ($distributors as $index => $dist) {
                // Distributor 1 and 2 order more often (Top Performers)
                $multiplier = ($index < 2) ? 1.5 : 1.0;
                $orderCount = max(1, round(rand(1, 3) * $growthFactor * $multiplier));
                
                for ($k = 0; $k < $orderCount; $k++) {
                    $orderDate = $baseDate->copy()->startOfMonth()->addDays(rand(1, 28));
                    // Keep time varied
                    $orderDate->setTime(rand(8, 20), rand(0, 59));

                    $total = 0;
                    $items = [];
                    foreach ($products as $prod) {
                        if (rand(0, 10) > 4) { // 60% chance to order a product
                            $qty = rand(20, 100);
                            $price = $prod->price_admin;
                            $subtotal = $qty * $price;
                            $total += $subtotal;
                            $items[] = [
                                'product_id' => $prod->id,
                                'quantity' => $qty,
                                'price' => $price,
                                'subtotal' => $subtotal
                            ];
                        }
                    }

                    if ($total > 0) {
                        $order = Order::create([
                            'invoice_no' => 'INV-RST-' . strtoupper(Str::random(10)), // FIXED: invoice_no, not order_number
                            'buyer_id' => $dist->id,
                            'seller_id' => $admin->id,
                            'total_amount' => $total,
                            'status' => 'completed',
                            'type' => 'restock',
                            'payment_proof' => 'dummy.jpg',
                            'notes' => 'Restock Order',
                            'created_at' => $orderDate,
                            'updated_at' => $orderDate,
                        ]);

                        foreach ($items as $item) {
                            OrderItem::create([
                                'order_id' => $order->id,
                                'product_id' => $item['product_id'],
                                'quantity' => $item['quantity'],
                                'price' => $item['price'],
                                'subtotal' => $item['subtotal'],
                            ]);
                        }
                    }
                }
            }

            // B. Customer Orders (Distributor Revenue)
            foreach ($customers as $cust) {
                // Customers buy 1-4 times a month
                $purchaseCount = rand(1, 4);
                
                for ($k = 0; $k < $purchaseCount; $k++) {
                    $orderDate = $baseDate->copy()->startOfMonth()->addDays(rand(1, 28));
                    $orderDate->setTime(rand(9, 22), rand(0, 59));

                    // Random distributor, but weighted
                    $distIndex = rand(0, count($distributors) - 1);
                    if (rand(0,10) > 6) $distIndex = 0; // 40% chance bias to Dist 1
                    
                    $seller = $distributors[$distIndex];
                    
                    $total = 0;
                    $items = [];
                    foreach ($products as $prod) {
                        if (rand(0, 1)) {
                            $qty = rand(1, 3);
                            $price = $prod->price_retail;
                            $subtotal = $qty * $price;
                            $total += $subtotal;
                            $items[] = [
                                'product_id' => $prod->id,
                                'quantity' => $qty,
                                'price' => $price,
                                'subtotal' => $subtotal
                            ];
                        }
                    }

                    if ($total > 0) {
                        $order = Order::create([
                            'invoice_no' => 'INV-CUST-' . strtoupper(Str::random(10)), // FIXED: invoice_no
                            'buyer_id' => $cust->id,
                            'seller_id' => $seller->id,
                            'total_amount' => $total,
                            'status' => 'completed',
                            'type' => 'customer_purchase',
                            'payment_proof' => 'dummy.jpg',
                            'notes' => 'Customer Purchase',
                            'created_at' => $orderDate,
                            'updated_at' => $orderDate,
                        ]);

                        foreach ($items as $item) {
                            OrderItem::create([
                                'order_id' => $order->id,
                                'product_id' => $item['product_id'],
                                'quantity' => $item['quantity'],
                                'price' => $item['price'],
                                'subtotal' => $item['subtotal'],
                            ]);
                        }
                    }
                }
            }
        }
    }
}
