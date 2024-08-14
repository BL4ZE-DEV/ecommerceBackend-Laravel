<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class order extends Model
{
    use HasFactory, HasUuids;


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderItem() : HasMany
    {
        return $this->hasMany(orderItem::class, 'orderId');
    }

    public function payment() : HasOne
    {
        return $this->hasOne(payment::class, 'orderId');
    }
}
