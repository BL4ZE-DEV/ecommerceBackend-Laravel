<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Middleware\RoleMiddleware;
use App\Models\CartProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('google-login', [AuthenticationController::class,'redirectToGoogle']);
// Route::get('google-register', [AuthenticationController::class, 'googleRegister']);


Route::post('auth/register', [AuthenticationController::class, 'register']);
Route::post('auth/login', [AuthenticationController::class, 'login']);
Route::post('auth/adminLogin', [AdminController::class, 'login']);


Route::middleware(['auth:api'])->group(function () {

    Route::middleware(['role:seller'])->group(function () {

        Route::prefix('category')->as('category.')->group(function () {
            Route::post('/', [CategoryController::class, 'store']);  
            Route::put('/{category}', [CategoryController::class, 'update']);
            Route::delete('/{category}', [CategoryController::class, 'delete']);
        });

        Route::prefix('product')->as('product.')->group(function () {
            Route::post('/', [ProductController::class, 'store']);
            Route::put('/{product}', [ProductController::class, 'update']);
            Route::delete('/{product}', [ProductController::class, 'delete']);
        });
    });

    Route::prefix('cart')->as('cart.')->group(function() {
        Route::post('/', [CartProductController::class, 'addTocart']);
        Route::get('/', [ShoppingCartController::class, 'getCart']);
        Route::delete('/clearCart', [ShoppingCartController::class, 'clearCart']);
        Route::get('/listCartProduct', [CartProductController::class, 'listCartProduct']);
        Route::patch('/{productId}/updateQunatity', [CartProductController::class, 'updateQuantity']);
        Route::delete('/{productId}/removeFromCart', [CartProductController::class, 'removeFromCart']);
    });

    Route::prefix('product')->as('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/{product}', [ProductController::class, 'show']);
    });

    Route::prefix('category')->as('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/{category}', [CategoryController::class, 'show']);
    });
});
