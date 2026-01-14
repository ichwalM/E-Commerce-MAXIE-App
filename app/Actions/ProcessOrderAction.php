<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\ProductStock;
use App\Models\DistributorStock;
use Illuminate\Support\Facades\DB;

class ProcessOrderAction
{
    public function execute(Order $order, string $status): Order
    {
        return DB::transaction(function () use ($order, $status) {
            if ($order->status === 'completed' || $order->status === 'cancelled') {
                throw new \Exception("Order is already processed.");
            }

            if ($status === 'completed' && $order->type === 'restock') {
                // Admin approves restock: Decrease Admin Stock, Increase Distributor Stock
                foreach ($order->items as $item) {
                    // Decrease Admin Stock
                    $adminStock = ProductStock::where('product_id', $item->product_id)->lockForUpdate()->first();
                    if (!$adminStock || $adminStock->quantity < $item->quantity) {
                        throw new \Exception("Insufficient global stock for product ID: {$item->product_id}");
                    }
                    $adminStock->decrement('quantity', $item->quantity);

                    // Increase Distributor Stock
                    DistributorStock::updateOrCreate(
                        ['user_id' => $order->buyer_id, 'product_id' => $item->product_id],
                        ['quantity' => DB::raw("quantity + {$item->quantity}")]
                    );
                }
            } elseif ($status === 'completed' && $order->type === 'customer_purchase') {
                // Distributor fulfills order: Decrease Distributor Stock
                foreach ($order->items as $item) {
                     $distStock = DistributorStock::where('user_id', $order->seller_id)
                        ->where('product_id', $item->product_id)
                        ->lockForUpdate()
                        ->first();
                    
                     if (!$distStock || $distStock->quantity < $item->quantity) {
                        throw new \Exception("Insufficient distributor stock for product ID: {$item->product_id}");
                    }
                    $distStock->decrement('quantity', $item->quantity);
                }
            }

            $order->update(['status' => $status]);
            return $order;
        });
    }
}
