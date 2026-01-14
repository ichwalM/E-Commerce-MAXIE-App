<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        if ($user->role === 'admin') {
            // 1. Distributor Stats: Total Sales per Distributor (Customer Purchases)
            $distributorStats = \App\Models\User::where('role', 'distributor')
                ->where('is_active', true)
                ->withSum(['ordersAsSeller' => function ($query) {
                    $query->where('status', 'completed')
                          ->where('type', 'customer_purchase');
                }], 'total_amount')
                ->get()
                ->map(function ($distributor) {
                    return [
                        'name' => $distributor->name,
                        'revenue' => $distributor->orders_as_seller_sum_total_amount ?? 0,
                        'order_count' => $distributor->ordersAsSeller()->where('status', 'completed')->count()
                    ];
                });

            // 2. Admin Revenue: Total amount from Restock orders
            $adminRevenue = \App\Models\Order::where('type', 'restock')
                ->where('status', 'completed') // Assuming completed means paid to admin
                ->sum('total_amount');

            // 3. Prepare Chart Data
            // Chart 1: Distributor Revenue Comparison
            $chartDistributorLabels = $distributorStats->pluck('name')->toArray();
            $chartDistributorRevenue = $distributorStats->pluck('revenue')->toArray();

            return view('dashboard', compact('distributorStats', 'adminRevenue', 'chartDistributorLabels', 'chartDistributorRevenue'));
        }

        return view('dashboard');
    }
}
