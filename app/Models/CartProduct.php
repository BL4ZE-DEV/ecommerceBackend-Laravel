<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartProduct extends Model
{
    use HasFactory;


    public function shoppingCart() : BelongsTo
    {
        return $this->belongsTo(shoppingCart::class, 'cartId');
    }

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class, 'productId');
    }
}
