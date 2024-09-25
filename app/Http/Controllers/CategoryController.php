<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RoleMiddleware;
use App\Models\category;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;


class CategoryController extends Controller
{

    public function index(){
        $categories = Category::latest()
                    ->with('products')
                    ->paginate(10);

        return response()->json([
            'status' => 'true',
            'Data' => $categories
        ]);
    }

    public function store(StorecategoryRequest $request){
        $category = category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'category created successfully',
            'data' => $category
        ]);
    }


    public function show(category $category)
    {
         $categoryProduct  = $category->load('products'); 
        return response()->json([
            'status' => true,
            'message' => 'Category fetched succesfully !',
            'data' => $categoryProduct
         ]);
    }

    public function update(UpdatecategoryRequest $request, category $category){
        $data = $category->update([
            'name' => $request->name ?? $category->name,
            'description' => $request->description ?? $category->description
         ]);
          
         if($data){
            return response()->json([
                'status' => true,
                'message' => 'category updated succesfully',
            ]);

            return response()->json([
                'status' => false,
                'message' => 'error'
            ]);
        }
    }

    public function delete($category){
    
        $category = category::where('categoryId', $category)->delete();   
        
        if($category){
            return response()->json([
            'status' => true,
            'message' => 'category deleted successfuly'
        ]);
             
        }           
    }  
}
