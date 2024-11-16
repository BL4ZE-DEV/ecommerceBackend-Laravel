<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Http\Requests\StoreCartProductRequest;
use App\Http\Requests\UpdateCartProductRequest;
use App\Models\Product;
use App\Models\shoppingCart;
use Illuminate\Support\Facades\Auth;

class CartProductController extends Controller
{
    public function addToCart(StoreCartProductRequest $request){

        $cart  = shoppingCart::firstOrCreate([
            'userId' => Auth::user()->userId
        ]);

        $product = Product::findOrFail($request->productId);

        $cartProduct = CartProduct::where('cartId' , $cart->cartId)
                                  ->where('productId', $product->productId)
                                  ->first();

        if($cartProduct){
            $cartProduct->update([
                'quantity' => $cartProduct->quantity + $request->quantity,
                'amount' => $product->price
            ]);
        }else{
            CartProduct::create([
                'cartId' => $cart->cartId,
                'productId' => $product->productId,
                'amount' => $product->price,
                'quantity' => $request->quantity           
            ]);
        }

        return response()->json([
            'status' => true, 
            'message' => 'Product added to cart'
        ]);
    
    }

    public function removeFromCart($productId)
    {
        $cart = shoppingCart::where('userId', Auth::user()->userId)->first();

        $product = Product::where('productId', $productId);

        $cartProduct =  CartProduct::where('cartId', $cart->cartId)
                                    ->where('productId', $product->productId)
                                    ->first();
        if($cartProduct){
            $cartProduct->delete();

            return response()->json([
                'status' => true, 
                'message' => 'product removed from cart'
            ]);
        }
    }

    public function updateQuantity(UpdateCartProductRequest $request, $productId)
    {
        $cart = shoppingCart::where('userId', Auth::user()->userId)->first();

        $product = Product::where('productId', $productId);

        $cartProduct =  CartProduct::where('cartId', $cart->cartId)
                                    ->where('productId', $product->productId)
                                    ->first();

        if($cartProduct){

            $cartProduct->update([
                'quantity' => $request->quantity ?? $cartProduct->quantity
            ]);

            $cartProduct->save();

            return response()->json([
                'status' => true, 
                'message' => 'quantity updated successfully'
            ]);
        }
    }

    public function listCartProduct()
    {
        $cart = shoppingCart::where('userId', Auth::user()->userId)->first();

        if(!$cart)
        {
            response()->json([
                'status' => false,
                'message' => 'cart is empty'
            ],200);
        }

        $cartProduct = CartProduct::where('cartId', $cart->cartId)
                                    ->with('product')
                                    ->get();
        if($cartProduct){
            return response()->json([
                'status' => true,
                'cartProduct' => $cartProduct
            ]);
        }
    }
}
