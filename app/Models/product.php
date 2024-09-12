<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, HasUuids;

     protected $primaryKey = 'productId';

     protected $keyType = 'keyType';

     public $incrementing = false;


     protected $fillable  = [
        'name',
        'quantity',
        'price',
        'description',
        'categoryId'
     ];

     protected $hidden = [
        'id',
        'created_at',
        'updated_at'
     ];

     protected static function boot(){
        parent::boot();
    
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
    public function catgeory() : BelongsTo
    {
        return $this->belongsTo(category::class,'CategoryId');
    }

    public function orderItem() : HasMany
    {
        return $this->hasMany(orderItem::class, 'productId');
    }

    public function shoppingCart() : HasMany
    {
        return $this->hasMany(shoppingCart::class, 'productId');
    }

    public function cartProduct() : HasMany 
    {
        return $this->hasMany(CartProduct::class, 'productId');    
    }
}