<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\support\Str; 

class shoppingCart extends Model
{
    use HasFactory, HasUuids;
    
    protected $primaryKey = 'cartId' ;

    public $incrementing = false;

    protected $keyType = 'string';


    protected $fillable = [
        'userId'
    ];



    public static function boot(){
        Parent::boot();

        static::creating(function($model){
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function cartsProduct() : HasMany
    {
        return $this->hasMany(CartProduct::class, 'cartId');
    }

    
}