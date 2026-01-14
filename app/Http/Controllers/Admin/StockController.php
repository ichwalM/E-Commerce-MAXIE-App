<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\UpdateStockAction;
use App\Models\Product;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::with('stock')->get();
        return view('admin.stock.index', compact('products'));
    }

    public function update(Request $request, UpdateStockAction $action)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'operation' => 'required|in:add,subtract',
        ]);

        try {
            $action->execute($request->product_id, $request->quantity, $request->operation);
            return back()->with('success', 'Stock updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
