<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DistributorStock;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index()
    {
        $stocks = DistributorStock::where('user_id', Auth::id())
            ->with('product')
            ->get();
            
        return view('distributor.stock.index', compact('stocks'));
    }
}
