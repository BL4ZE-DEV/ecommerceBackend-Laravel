<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
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
            'email' => 'required|email',
            'amount' => 'required|interger|min:1'
        ]);

        if($shoppingCart->empty()){
            return response()->json([
                'Status' => FALSE,
                'message' => 'Empty Cart'
            ]);
        }

        $data = [
            'email' => $request->email,
            'amount' => $request->amount,
            'refrence' => 'txn_'. uniqid(),
            'callback_url' => '',
            'metaData' => [
                'cartId' => $shoppingCart->id,
                'userId' => Auth::user()->id
            ]
        ];
    }


    public function callback(){
        
    }
}

