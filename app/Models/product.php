<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class product extends Model
{
    use HasFactory, HasUuids;


    public function catgeory() : BelongsTo
    {
        return $this->belongsTo(category::class);
    }

    public function orderItem() : HasMany
    {
        return $this->hasMany(orderItem::class, 'productId');
    }

    public function shoppingCart() : HasMany
    {
        return $this->hasMany(shoppingCart::class, 'productId');
    }
}