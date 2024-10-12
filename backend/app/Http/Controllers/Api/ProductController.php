<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\NewProductRequest;
use App\Http\Responses\ApiResponse;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Http\Request;

class ProductController
{
    protected ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService){
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->productService->getHotProductBySale();
    }
    public function allProducts(){
        return $this->productService->getAllProductAvailable();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(NewProductRequest $request)
    {
        $dataProductToTrans = array_merge($request->validated(),['Images' => $request->file('Images')]);
        $responseProduct = $this->productService->insertNewProduct($dataProductToTrans);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->productService->getProductDetail($id);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
