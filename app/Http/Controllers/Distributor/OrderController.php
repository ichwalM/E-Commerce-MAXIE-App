<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\CreateOrderAction;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('buyer_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('distributor.orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::where('is_active', true)->get();
        return view('distributor.orders.create', compact('products'));
    }

    public function store(Request $request, CreateOrderAction $action)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        // Filter out items with 0 quantity if any slip through
        $items = array_filter($request->items, fn($item) => $item['quantity'] > 0);

        if (empty($items)) {
            return back()->withErrors(['items' => 'Please select at least one product.']);
        }

        // Find Admin to be the seller (Assuming first admin for now or general system)
        $admin = User::where('role', 'admin')->firstOrFail();

        $order = $action->execute([
            'buyer_id' => Auth::id(),
            'seller_id' => $admin->id,
            'type' => 'restock',
            'items' => $items,
            'notes' => $request->notes,
        ]);

        return redirect()->route('distributor.orders.index')->with('success', 'Restock request placed successfully. Invoice: ' . $order->invoice_no);
    }

    public function show(Order $order)
    {
        if ($order->buyer_id !== Auth::id()) {
            abort(403);
        }
        return view('distributor.orders.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        if ($order->buyer_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'pending') {
            return back()->with('error', 'Only pending orders can be cancelled.');
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('distributor.orders.index')->with('success', 'Order cancelled successfully.');
    }
}
