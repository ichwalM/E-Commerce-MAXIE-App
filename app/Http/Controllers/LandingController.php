<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::where('is_active', true)->get();
        return view('landing.index', compact('products'));
    }

    public function about()
    {
        return view('landing.about');
    }

    public function shop()
    {
        $products = \App\Models\Product::where('is_active', true)->orderBy('name')->paginate(12);
        return view('landing.shop', compact('products'));
    }

    public function show(\App\Models\Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }
        
        // Load related products (random for now, or same category if categories existed)
        $relatedProducts = \App\Models\Product::where('is_active', true)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('landing.product', compact('product', 'relatedProducts'));
    }

    public function bestSellers()
    {
        // Get products ordered by total quantity sold in completed customer purchases
        $products = \App\Models\Product::where('is_active', true)
            ->withSum(['orderItems as sold_count' => function ($query) {
                $query->whereHas('order', function ($q) {
                    $q->where('status', 'completed')
                      ->where('type', 'customer_purchase');
                });
            }], 'quantity')
            ->orderByDesc('sold_count')
            ->take(8)
            ->get();

        return view('landing.best-sellers', compact('products'));
    }
}
