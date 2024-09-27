<?php

// namespace App\Http\Controllers;

// use App\Models\payment;
// use App\Http\Requests\StorepaymentRequest;
// use App\Http\Requests\UpdatepaymentRequest;
// use App\Models\order;
// use App\Models\shoppingCart;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class PaymentController extends Controller
// {
//     public function checkout(Request $request, shoppingCart $shoppingCart){
//         $request->validate([
//             'shipping_address' => 'required|string',
//             'payment_method' => 'required|string'
//         ]);

//         order::create([
//             'userId' => Auth::user()->userId,
//             'cartId' => $shoppingCart->cartId,
//             'shipping_address' => $request->shipping_address,
//             'payment_method' => $request->payment_method

//         ]);

        
//     }
// }
