<?php

namespace App\Http\Controllers;

use App\Models\shoppingCart;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{

    public function getCart()
    {
        $user =  Auth::user();

        $cart = shoppingCart::where('userId', $user->userId)->with('cartsProduct')->first();

        if(!$cart){
            return response()->json([
                'message' => 'cart is empty'
            ]);
        }

        return response()->json([
            'messsage' => 'cart received successfully',
            'cart' => $cart
        ]);
    }

    public function clearCart()
    {
        $userId = Auth::user()->userId;
        $cart = ShoppingCart::where('userId', $userId)->first();

        if ($cart) {
            $cart->cartsProduct()->delete();
            return response()->json(['message' => 'Cart cleared successfully'], 200);
        }

        return response()->json(['message' => 'Cart not found'], 404);
    }
}
 