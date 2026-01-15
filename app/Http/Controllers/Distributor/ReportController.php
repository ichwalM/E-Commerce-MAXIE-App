<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\ExportSalesAction;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $query = Order::where('seller_id', Auth::id())
            ->where('status', 'completed')
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate);

        $salesStats = (clone $query)->select(
                DB::raw('sum(total_amount) as total_revenue'),
                DB::raw('count(*) as total_orders')
            )->first();

        $recentSales = (clone $query)->latest()
            ->get(); // Get actual filtered list for the table

        return view('distributor.reports.index', compact('salesStats', 'recentSales', 'startDate', 'endDate'));
    }

    public function export(Request $request, ExportSalesAction $action)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        return $action->execute($startDate, $endDate);
    }
}
