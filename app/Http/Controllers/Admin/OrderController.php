<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\ProcessOrderAction;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('seller_id', auth()->id()) // Admin is seller for Restock
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.orders.index', compact('orders'));
    }
    
    public function show(Order $order)
    {
        // Ensure Admin can view this order (either seller or general admin power)
        return view('admin.orders.show', compact('order'));
    }
    
    public function update(Request $request, Order $order, ProcessOrderAction $action)
    {
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
