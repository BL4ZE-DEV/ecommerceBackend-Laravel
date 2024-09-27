<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class order extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'orderId';


    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'userId',
        'cartId',
        'shipping_address',
        'payment_method'
    ];


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

    protected static function boot(){
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
