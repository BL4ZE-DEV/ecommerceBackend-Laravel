<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\payment;
use App\Http\Requests\StorepaymentRequest;
use App\Http\Requests\UpdatepaymentRequest;
use App\Models\order;
use App\Models\Product;
use App\Models\shoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Charge;
use Stripe\Stripe;
use Throwable;

class PaymentController extends Controller
{
    public function checkout(Request $request, shoppingCart $shoppingCart){
        $request->validate([
            'shipping_address' => 'required|string',
            'payment_method' => 'required|string'
        ]);

        if($shoppingCart->cartsProduct()->count() === 0){
            return response()->json([
                'status' => false,
                'message' => 'Empty Cart!'
            ]);
        }

        $total = $shoppingCart->cartsProduct->line_amount;

        $order = Order::create([
            'userId' =>  Auth::user()->userId,
            'cartId' => $shoppingCart->cartId,
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->method,
            'total_amount' => $total
        ]);


        foreach($shoppingCart->cartsProduct as $cartProduct){
            $product =  Product::where('productId', $cartProduct->productId)->first();

            if($product->quantity > $cartProduct->quantity){
                return response()->json([
                    'message' => 'not enough in stock'
                ]);
            }

            $product->quantity -= $cartProduct->quantity;
            $product->save();
        }

        try{
            Stripe::setApiKey(env('STRIPE_SECRET'));
            Charge::create([
                'amount' => $total * 100,
                'currency' => 'usd',
                'source' => $request->payment_method,
                'description' => 'order for'. Auth::user()->name
            ]);

            $order->update(['status' => OrderStatus::INPROGRESS]);

            $shoppingCart->cartsProduct->delete();

            return response()->json([
                'status' => true,
                'message' => 'checkout successful'
            ]);
        }catch(Throwable $e){
            return response()->json([
                'status' => false,
                'message' => 'error:'. $e->getMessage()
            ]);
        }

    }
}
