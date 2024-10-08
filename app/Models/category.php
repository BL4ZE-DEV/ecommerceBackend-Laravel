<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class category extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'categoryId';

    protected $keyType = 'string';
    
    public  $incrementing = false;


    protected $fillable = [
        'name',
        'description'
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


    public function products() : HasMany
    {
        return $this->hasMany(product::class, 'categoryId');
    }

}