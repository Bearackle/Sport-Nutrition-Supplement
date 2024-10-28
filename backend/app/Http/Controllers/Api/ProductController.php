<?php

namespace App\Http\Controllers\Api;

use App\Filters\ProductFilter;
use App\Http\Requests\NewProductRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UploadImageRequest;
use App\Http\Resources\ProductResource;
use App\Http\Responses\ApiResponse;
use App\Services\ImageService\ImageProductService;
use App\Services\Product\ProductServiceInterface;
use Cloudinary\Api\Exception\ApiError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ProductController
{
    protected ProductServiceInterface $productService;
    protected ImageProductService $imageProductService;

    public function __construct(ProductServiceInterface $productService, ImageProductService $imageProductService){
        $this->productService = $productService;
        $this->imageProductService = $imageProductService;
    }
    /**
     * Display a listing of the resource.
     * @OA\Get(
     *     path="products/pages",
     *     summary="hot product",
     *     tags={"Product"},
     *     description="Lấy sản phẩm hot nhất hiển thị trên trang chủ",
     *     @OA\Response(response=200,description="Lấy sản phẩm thành công"),
     *     @OA\Response(response=400, description="Lỗi mạng")
     * )
     */
    public function index()
    {
        return $this->productService->getHotProductBySale();
    }

    /**
     * @OA\Get(
     *     path="
     * )
     */
    public function filter(Request $request,ProductFilter $productFilter){
        return $this->productService->filter($productFilter);
    }
    public function CategoryProduct($id){
        return $this->productService->getCategoryProduct($id);
    }
    public function allProducts(): ProductResource
    {
        $products = $this->productService->getProducts();
        return new ProductResource($products);
    }

    /**
     * Store a newly created resource in storage.
     * @throws ApiError
     */
    public function store(NewProductRequest $request) : ApiResponse
    {
        $dataProductToTrans = $request->validated();
        $responseProduct = $this->productService->insertNewProduct($dataProductToTrans);
        $this->imageProductService->addImagesProduct($responseProduct['ProductID'],$request->file('Images'));
        if($responseProduct){
            return new ApiResponse(200,['message' => 'Product added successfully']);
        }
        return new ApiResponse(200,['message' => 'Product not added']);
    }

    /**
     * Display the specified resource.
     * @OA\Get(
     *     path="/products/{id}",
     *     summary="Get product detail of a product",
     *     tags={"Product"},
     * @OA\Response(response=200, description="Success")
     * )
     *
     */
    public function show(string $id) : ApiResponse
    {
         $data = $this->productService->getProductDetail($id);
         return new ApiResponse(200,[$data]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request): ApiResponse
    {
        $dataToTrans = $request->validated();
        $result = $this->productService->updateProduct($request->input('ProductID'),$dataToTrans);
        if($result){
            return new ApiResponse(200,['message' => 'Product updated successfully']);
        }
        return new ApiResponse(200,['message' => 'Product not updated']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): ApiResponse
    {
        $result = $this->productService->deleteProduct($id);
        if($result){
            return new ApiResponse(200,['message' => 'Product deleted successfully']);
        }
        return new ApiResponse(200,['message' => 'Product not deleted']);
    }

    /**
     * @throws ApiError
     */
    public function uploadImage(UploadImageRequest $request) : void
    {
        $this->imageProductService->addImagesProduct($request->validated(), $request->file('Images'));
    }
    /**
     * @throws ApiError
     */
    public function updateImage(UpdateImageRequest $request,string $id)  : void    {
        $this->imageProductService->updateUploadedImage($request->input('ImageID'),
            $request->file('Image'));
    }
    public function destroyImage(string $image_id) : void
    {
        $this->imageProductService->deleteImage($image_id);
    }
}
