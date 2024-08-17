<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class shoppingCart extends Model
{
    use HasFactory, HasUuids;

    public function product() : BelongsTo
    {
        return $this->belongsTo(product::class, 'productId');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }
}