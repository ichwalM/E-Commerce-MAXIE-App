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
                ->where('status', 'completed')
                ->sum('total_amount');

            // 3. Monthly Sales Analytics (Last 6 Months)
            $monthlySales = \App\Models\Order::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(total_amount) as total')
                ->where('type', 'restock')
                ->where('status', 'completed')
                ->where('created_at', '>=', now()->subMonths(6))
                ->groupBy('year', 'month')
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();

            $chartMonthlyLabels = [];
            $chartMonthlyRevenue = [];

            // Fill in missing months if any, or just map existing
            // For simplicity, let's map existing first. A robust solution fills zeros.
            foreach($monthlySales as $sale) {
                $dateObj = \DateTime::createFromFormat('!m', $sale->month);
                $chartMonthlyLabels[] = $dateObj->format('F'); // Month Name
                $chartMonthlyRevenue[] = $sale->total;
            }

            // 4. Prepare Chart Data
            // Chart 1: Distributor Revenue Comparison
            $chartDistributorLabels = $distributorStats->pluck('name')->toArray();
            $chartDistributorRevenue = $distributorStats->pluck('revenue')->toArray();

            return view('dashboard', compact(
                'distributorStats', 
                'adminRevenue', 
                'chartDistributorLabels', 
                'chartDistributorRevenue',
                'chartMonthlyLabels',
                'chartMonthlyRevenue'
            ));
        }

        return view('dashboard');
    }
}
