<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreuserRequest;
use App\Mail\RegistrationSuccesful;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

class AuthenticationController extends Controller
{
    public function register(StoreuserRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);
    
        if (!$user) {
            return response()->json([
                'message' => 'error Registration unsuccessful'
            ], 402);
        }
    
        $token = JWTAuth::fromUser($user);
    
        try {
            Mail::to($request->email)->send(new RegistrationSuccesful(['name' => $request->name, 'phone' => $request->phone]));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage()
            ]);
        }
    
        return response()->json([
            'message' => 'Registration successful',
            'token' => $token,
            'data' => $user
        ], 200);

    }

    public function login(Request $request){

        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'invalid credentials'
            ],401);
        }

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'login successful',
            'token' => $token,
            'data' => $user
        ]);
    }
}
