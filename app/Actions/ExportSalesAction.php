<?php

namespace App\Actions;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ExportSalesAction
{
    public function execute()
    {
        $orders = Order::where('seller_id', Auth::id())
            ->where('status', 'completed')
            ->with(['buyer', 'items.product'])
            ->get();

        $filename = "sales_report_" . date('Ymd_His') . ".csv";
        $handle = fopen('php://temp', 'r+');

        // Add BOM for Excel compatibility
        fputs($handle, "\xEF\xBB\xBF");

        // Header
        fputcsv($handle, ['Invoice', 'Date', 'Customer', 'Role', 'Total Amount', 'Items']);

        foreach ($orders as $order) {
            $itemsSummary = $order->items->map(function ($item) {
                return "{$item->product->name} x{$item->quantity}";
            })->implode('; ');

            fputcsv($handle, [
                $order->invoice_no,
                $order->created_at->format('Y-m-d H:i:s'),
                $order->buyer->name,
                ucfirst($order->buyer->role),
                $order->total_amount,
                $itemsSummary
            ]);
        }

        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return response($content)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
    }
}
