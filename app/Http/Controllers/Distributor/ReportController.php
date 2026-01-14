<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\ExportSalesAction;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $salesStats = Order::where('seller_id', Auth::id())
            ->where('status', 'completed')
            ->select(
                DB::raw('sum(total_amount) as total_revenue'),
                DB::raw('count(*) as total_orders')
            )
            ->first();

        $recentSales = Order::where('seller_id', Auth::id())
            ->where('status', 'completed')
            ->latest()
            ->take(5)
            ->get();

        return view('distributor.reports.index', compact('salesStats', 'recentSales'));
    }

    public function export(ExportSalesAction $action)
    {
        return $action->execute();
    }
}
