<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\NewProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
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
    public function store(NewProductRequest $request) : ApiResponse
    {
        $dataProductToTrans = array_merge($request->validated(),['Images' => $request->file('Images')]);
        $responseProduct = $this->productService->insertNewProduct($dataProductToTrans);
        if($responseProduct){
            return new ApiResponse(200,['message' => 'Product added successfully']);
        }
        return new ApiResponse(200,['message' => 'Product not added']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : ApiResponse
    {
         $data = $this->productService->getProductDetail($id);
         return new ApiResponse(200,[$data]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request)
    {
        $dataToTrans = array_merge($request->validated(),['Images' => $request->file('Images')]);
        $result = $this->productService->updateProduct($dataToTrans['ProductID'],$dataToTrans);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->productService->deleteProduct($id);
        if($result){
            return new ApiResponse(200,['message' => 'Product deleted successfully']);
        }
        return new ApiResponse(200,['message' => 'Product not deleted']);
    }
}
