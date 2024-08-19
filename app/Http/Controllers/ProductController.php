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
        $category = category::where('name', $request->category_name);
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' =>$request->price,
            'categoryId' => $category->categoryId
        ]);

        return response()->json([
            'status' => true,
            'message' => 'product created successfully',
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
        $category = category::where('name', $request->category_name);
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
                'data' => $data
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
