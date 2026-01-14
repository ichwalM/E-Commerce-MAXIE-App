<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\CreateOrderAction;
use App\Models\DistributorStock;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
         $orders = Order::where('buyer_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('customer.orders.index', compact('orders'));
    }

    public function create(Request $request)
    {
        $productId = $request->query('product_id');
        if (!$productId) {
            return redirect()->route('customer.products.index');
        }

        $product = Product::findOrFail($productId);
        
        // Find distributors who have stock of this product
        $distributors = DistributorStock::where('product_id', $productId)
            ->where('quantity', '>', 0)
            ->with(['user.distributorProfile'])
            ->get();

        return view('customer.orders.create', compact('product', 'distributors'));
    }

    public function store(Request $request, CreateOrderAction $action)
    {
        $request->validate([
            'seller_id' => 'required|exists:users,id', // The selected distributor
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $order = $action->execute([
            'buyer_id' => Auth::id(),
            'seller_id' => $request->seller_id,
            'type' => 'customer_purchase',
            'items' => $request->items,
            'notes' => $request->notes,
        ]);

        return redirect()->route('customer.orders.index')->with('success', 'Order placed successfully. Your Invoice: ' . $order->invoice_no);
    }

    public function show(Order $order)
    {
        if ($order->buyer_id !== Auth::id()) {
            abort(403);
        }
        return view('customer.orders.show', compact('order'));
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

        return redirect()->route('customer.orders.index')->with('success', 'Order cancelled successfully.');
    }
}
