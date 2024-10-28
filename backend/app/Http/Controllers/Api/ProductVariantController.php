<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewProductVariants;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Requests\UpdateVariantRequest;
use App\Http\Responses\ApiResponse;
use App\Models\ProductVariant;
use App\Services\ImageService\ImageProductServiceInterface;
use App\Services\Product\ProductVariantServiceInterface;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected ProductVariantServiceInterface $productVariantService;
    protected ImageProductServiceInterface $imageProductService;
    public function __construct(ProductVariantServiceInterface $productVariantService,
                                ImageProductServiceInterface $imageProductService)
    {
        $this->productVariantService = $productVariantService;
        $this->imageProductService = $imageProductService;
    }
    public function index()
    {
        //
    }
    public function VariantsOfProduct($id)
    {
        return $this->productVariantService->getVariantsData($id);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(NewProductVariants $request)
    {
        $dataToTrans = array_merge($request->validated(),[$request->file('Image')]);
        return $this->productVariantService->insertProductVariant($dataToTrans);
    }
    public function update(UpdateVariantRequest $request) : ApiResponse
    {
        $dataToTrans = $request->validated();
        $result = $this->productVariantService->updateProductVariant($dataToTrans);
        $image = $request->file('Image');
        if($image){

        }
        if(!$result){
            return new ApiResponse(400,['message' =>'Fail update']);
        }
        return new ApiResponse(200,['message' =>'Update success']);
    }
    public function updateImage(UpdateImageRequest $request) : void {
        $this->imageProductService->updateUploadedImage($request->input('ImageID'),
            $request->file('Images'));
    }
    public function destroy($id) : ApiResponse
    {
        $result = $this->productVariantService->deleteVariant($id);
        if($result){
            return new ApiResponse(200,['message' =>'Delete success']);
        }
        return new ApiResponse(400,['message' =>'Delete fail']);
    }
}
