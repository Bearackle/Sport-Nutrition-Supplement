<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class ProductController
{
    protected $productService;
    public function __construct(ProductServiceInterface $productService){
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
       return $this->productService->getAllProductAvailable();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
