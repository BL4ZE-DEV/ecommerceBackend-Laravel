<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminController extends Controller
{
    public function Login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if(!$admin || !Hash::check($request->password , $admin->password)){
             return response()->json([
                'message' => 'invalid credentials'
            ],401);
        }

        $token  = JWTAuth::FromUser($admin);

       return  response()->json([
            'message' => 'login successful',
            'token' => $token,
            'data' => $admin
            ]);

    }
}
