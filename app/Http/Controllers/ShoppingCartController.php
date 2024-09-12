<?php

namespace App\Http\Controllers;

use App\Models\shoppingCart;
use App\Http\Requests\StoreshoppingCartRequest;
use App\Http\Requests\UpdateshoppingCartRequest;

class ShoppingCartController extends Controller
{

    public function addToCart(StoreshoppingCartRequest $request){  
        $cart = shoppingCart::create([
            
        ]); 
    }
   
}
