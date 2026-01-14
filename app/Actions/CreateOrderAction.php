<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateOrderAction
{
    public function execute(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            // 1. Calculate Total & Prepare Items
            $totalAmount = 0;
            $itemsToCreate = [];

            foreach ($data['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                
                // Determine price based on context (distributor buying from admin vs customer buying)
                // For now assuming Distributor buying from Admin uses price_admin? 
                // Specification: "Distributor determines price_selling". 
                // But when Buying, they pay Admin Price? 
                // Implementation Plan says: "Distributor Purchasing (from Admin)".
                // Usually Distributor gets a discount or buys at wholesale (price_admin).
                $price = $data['type'] === 'restock' ? $product->price_admin : $product->price_retail; // Simplified logic

                $subtotal = $price * $item['quantity'];
                $totalAmount += $subtotal;

                $itemsToCreate[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'subtotal' => $subtotal,
                ];
            }

            // 2. Create Order
            $order = Order::create([
                'invoice_no' => 'INV-' . strtoupper(Str::random(10)),
                'buyer_id' => $data['buyer_id'],
                'seller_id' => $data['seller_id'],
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'type' => $data['type'],
                'notes' => $data['notes'] ?? null,
            ]);

            // 3. Create Order Items
            foreach ($itemsToCreate as $itemData) {
                OrderItem::create(array_merge($itemData, ['order_id' => $order->id]));
            }

            return $order;
        });
    }
}
