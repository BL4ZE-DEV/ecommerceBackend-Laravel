<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use illuminate\Support\Str;

class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'roleId';

    protected $keyType = 'string';

    public $incrementing = false ;
    
    protected static function boot(){
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    public function user() : HasMany
    {
        return $this->hasMany(User::class, 'roleId');
    }   
}
