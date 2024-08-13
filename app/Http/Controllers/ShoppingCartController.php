<?php

namespace App\Http\Controllers;

use App\Models\shoppingCart;
use App\Http\Requests\StoreshoppingCartRequest;
use App\Http\Requests\UpdateshoppingCartRequest;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreshoppingCartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(shoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(shoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateshoppingCartRequest $request, shoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(shoppingCart $shoppingCart)
    {
        //
    }
}
