<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('auth/register', [AuthenticationController::class, 'register']);
Route::post('auth/login', [AuthenticationController::class, 'login']);


Route::middleware(['auth:api'])->prefix('category')->as('category')->group(function(){
    Route::middleware(['role:seller'])->group(function(){
        Route::post('/', [CategoryController::class, 'store']);  
        Route::put('/{category}', [CategoryController::class, 'update']);
        Route::delete('/{category}', [CategoryController::class, 'delete']);
    });
        Route::get('/{category}',  [CategoryController::class, 'show']);
        Route::get('/', [CategoryController::class,'index']);
});