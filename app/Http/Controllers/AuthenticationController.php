<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreuserRequest;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;

use function Laravel\Prompts\error;

class AuthenticationController extends Controller
{
    public function register(StoreUserRequest $request)
    {
    
        $role = Role::where('name', $request->role_name)->first();
    
        if ($role == null) {
            $role = Role::where('name', 'customer')->first();
        }
    
        if ($role) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => $role->name,
                'roleId' => $role->roleId
            ]);
        } else {
            return response()->json(['error' => 'Role not found'], 404);
        }
    
        $token = JWTAuth::fromUser($user);
    
        // try {
        //     Mail::to($request->email)->send(new RegistrationSuccesful(['name' => $request->name, 'phone' => $request->phone]));
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'message' => 'error',
        //         'error' => $e->getMessage()
        //     ]);
        // }
    
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

    public function redirectToGoogle()
    {
        try{
            return Socialite::driver('google')->stateless()->redirect();
        }catch (Exception $e) {
            return response()->json([
                'message' => 'Unable to redirect to Google',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    // public function googleRegister()
    // {
    //     try {

            

    //         $googleData = Socialite::driver('google')->stateless()->user();
    
    //         $existingUser = User::where('email', $googleData->getEmail())->first();
    
    //         if ($existingUser) {
    //             return response()->json([
    //                 'status' => 'Success',
    //                 'message' => 'User already registered',
    //                 'data' => $existingUser,
    //             ]);
    //         }
    
    //         $role = Role::where('name', 'customer')->first();
   
    //         $user = User::create([
    //             'UserId' => Str::uuid(),
    //             'roleId' => $role->RoleId,
    //             'name' => $googleData->getName(),
    //             'email' => $googleData->getEmail(),
    //             'password' => Hash::make(Str::random()), 
    //             'phone' => '08111841964', 
    //             'role' => $role->name,
    //         ]);

    //         $token = JWTAuth::fromUser($user);

    
    //         return response()->json([
    //             'status' => 'Success',
    //             'message' => 'User registered successfully',
    //             'token' => $token,
    //             'data' => $user,
    //         ]);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'status' => 'Error',
    //             'message' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
    
}
