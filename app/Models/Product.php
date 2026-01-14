<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    protected $guarded = ['id'];

    public function stock()
    {
        return $this->hasOne(ProductStock::class);
    }

    public function distributorStocks()
    {
        return $this->hasMany(DistributorStock::class);
    }
}
