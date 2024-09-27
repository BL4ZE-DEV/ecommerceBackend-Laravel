<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Http\Requests\StoreproductRequest;
use App\Http\Requests\UpdateproductRequest;
use App\Models\category;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->paginate(10);

        return response()->json([
            'status' => 'true',
            'Data' => $products
         ]);
    }

    public function store(StoreproductRequest $request){

        $product = product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'categoryId' => $request->categoryId
        ]);

        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $product
        ]);
    }


    public function show(product $product)
    {
        return response()->json([
            'status' => true,
            'message' => 'product fetched succesfully !',
            'data' => $product
         ]);
    }

    public function update(UpdateproductRequest $request, product $product){
        $category = category::where('categoryId', $request->categoryId);
        $data = $product->update([
            'name' => $request->name ?? $product->name,
            'description' => $request->description ?? $product->description,
            'quantity' => $request->quantity ?? $product->quantity,
            'categoryId' => $category->categoryId ?? $product->categoryId
         ]);

         if($data){
            return response()->json([
                'status' => 'success',
                'message' => 'Product updated succesfully',
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'error'
            ]);
        }
    }

    public function delete(product $product){
            if($product ->delete()){
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product deleted successfuly'
                ]);
            }
    }
}
