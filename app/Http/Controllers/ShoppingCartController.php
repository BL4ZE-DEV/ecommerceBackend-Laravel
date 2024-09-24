<?php

namespace App\Http\Controllers;

use App\Models\shoppingCart;
use App\Http\Requests\StoreshoppingCartRequest;
use App\Http\Requests\UpdateshoppingCartRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{

    public function getCart()
    {
        $user =  Auth::user();

        $cart = shoppingCart::where('userId', $user->userId)->with('cartProduct.product')->first();

        if(!$cart){
            return response()->json([
                'message' => 'cart is empty'
            ]);
        }

        return response()->json([
            'messsage' => 'cart received successfully'
        ]);
    }

    public function clearCart()
    {
        $userId = Auth::user()->userId;
        $cart = ShoppingCart::where('userId', $userId)->first();

        if ($cart) {
            $cart->cartProducts()->delete();
            return response()->json(['message' => 'Cart cleared successfully'], 200);
        }

        return response()->json(['message' => 'Cart not found'], 404);
    }
}
