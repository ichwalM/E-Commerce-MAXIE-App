<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\ProcessOrderAction;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index()
    {
        $orders = Order::where('seller_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('distributor.sales.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->seller_id !== Auth::id()) {
            abort(403);
        }
        return view('distributor.sales.show', compact('order'));
    }

    public function update(Request $request, Order $order, ProcessOrderAction $action)
    {
        if ($order->seller_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:completed,cancelled,shipped',
        ]);

        try {
            $action->execute($order, $request->status);
            return back()->with('success', 'Order status updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
