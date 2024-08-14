<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class orderItem extends Model
{
    use HasFactory, HasUuids;

    public function order() : BelongsTo
    {
        return $this->belongsTo(order::class);
    }

    public function product() : BelongsTo
    {
        return $this->belongsTo(product::class);
    }
}
