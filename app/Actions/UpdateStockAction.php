<?php

namespace App\Actions;

use App\Models\ProductStock;
use Illuminate\Support\Facades\DB;

class UpdateStockAction
{
    public function execute(int $productId, int $quantity, string $operation = 'add'): ProductStock
    {
        return DB::transaction(function () use ($productId, $quantity, $operation) {
            $stock = ProductStock::firstOrCreate(
                ['product_id' => $productId],
                ['quantity' => 0]
            );

            if ($operation === 'add') {
                $stock->increment('quantity', $quantity);
            } else {
                if ($stock->quantity < $quantity) {
                    throw new \Exception("Insufficient stock.");
                }
                $stock->decrement('quantity', $quantity);
            }

            return $stock->refresh();
        });
    }
}
