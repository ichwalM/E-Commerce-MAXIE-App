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
}
