<?php

namespace App\Http\Controllers\Api;

use App\DTOs\InputData\VariantInputData;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewProductVariants;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Requests\UpdateVariantRequest;
use App\Http\Responses\ApiResponse;
use App\Models\ProductVariant;
use App\Services\ImageService\ImageProductServiceInterface;
use App\Services\Product\ProductVariantServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    use AuthorizesRequests;
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
    /**
     * @OA\Get(
     *     path="/api/products/{id}/variants",
     *     tags={"Variant"},
     *     summary="Tìm mùi vị của sản phẩm",
     *     @OA\Parameter (
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="mã sản phẩm",
     *     ),
     *     @OA\Response(response=200, description="Tìm mùi vị thành công"),
     *     @OA\Response(response=400, description="Tìm mùi vị thất bại"),
     * )
     */
    public function VariantsOfProduct($id)
    {
        return $this->productVariantService->getVariantsData($id);
    }

    /**
     * @OA\Post(
     *     path="/api/products/variants",
     *     tags={"Variant"},
     *     summary="Tạo thêm mùi vị",
     *     description="Tạo mùi vị cho sản phẩm, yêu cầu có ảnh",
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="multipart/form-data",
     *        @OA\Schema(
     *            @OA\Property(property="VariantName",description="Tên mùi vị",type="string",example="Milk Tea Flavor"),
     *            @OA\Property (property="ProductID", description="Mã sản phẩm",format="int32", example="1"),
     *            @OA\Property (property="StockQuantity", description="Số lượng sản phẩm", format="int32", example="40"),
     *            @OA\Property (property="Image", description="File ảnh mùi vị", type="string", format="binary")
     *          )
     *        )
     *     ),
     *     @OA\Response(response=201,description="Tạo mùi vị thành công"),
     *     @OA\Response(response=400, description="Tạo mùi vị thất bại")
     * )
     * @throws AuthorizationException
     */
    public function store(NewProductVariants $request) : ApiResponse
    {
        $this->authorize('create', ProductVariant::class);
        $new_variant = $this->productVariantService->insertProductVariant(
            VariantInputData::validateAndCreate($request->validated()));
        $this->imageProductService->addImageVariants($new_variant->product_id, $new_variant->variant_id
            ,$request->file('image'));
        return new ApiResponse(201,[$new_variant]);
    }

    /**
     * @OA\Patch(
     *     path="/api/products/variants/{id}",
     *     tags={"Variant"},
     *     summary="Cập nhật thông tin mùi vị",
     *     description="Cập nhật thông tin mùi vị có {id}",
     *     @OA\Parameter (
     *         name="id",
     *         in="path",
     *         description="id mùi vị",
     *          required=true
     *     ),
     *    @OA\RequestBody(
     *           required=true,
     *           @OA\JsonContent(
     *               type="object",
     *               required={"VariantName","ProductID","StockQuantity"},
     *               @OA\Property(property="VariantName", type="string", example="chocola"),
     *               @OA\Property (property="ProductID", type="integer"),
     *               @OA\Property (property="StockQuantity", type="integer", example=10)
     *           )
     *      ),
     *     @OA\Response(response=200,description="cập nhật thành công"),
     *     @OA\Response(response=400, description="cập nhật thất bại")
     * )
     * @throws AuthorizationException
     */
    public function update(UpdateVariantRequest $request, string $id) : ApiResponse
    {
       // $this->authorize('update', ProductVariant::class);
        $result = $this->productVariantService->updateProductVariant(VariantInputData::from($request->validated(),['variant_id' => $id]));
        if(!$result){
            return new ApiResponse(400,['message' =>'Fail update']);
        }
        return new ApiResponse(200,['message' =>'Update success']);
    }

    /**
     * @OA\Patch(
     *     path="/api/products/variants/image/{image_id}",
     *     tags={"Variant"},
     *     summary="cập nhập hình ảnh mùi vị",
     *     description="Cập nhật hình ảnh mùi vị có image_id",
     *     @OA\Parameter (
     *         in="path",
     *         name="image_id",
     *         description="image id của mùi vị",
     *         required=true
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart-formdata",
     *          @OA\Schema(
     *              @OA\Property(property="Image", type="string", format="binary", description="Ảnh thay thế")
     *          ),
     *         )
     *     ),
     *     @OA\Response(response=200, description="Cập nhật ảnh thành công"),
     *     @OA\Response(response=400, description="Cập nhật ảnh thất bại")
     * )
     */
    public function updateImage(UpdateImageRequest $request,string $id) : void {
        $this->imageProductService->updateUploadedImage($id,
            $request->file('Image'));
    }
    /**
     * @OA\Delete(
     *     path="/api/products/variants/{id}",
     *     tags={"Variant"},
     *     description="Xóa một mùi vị có {id}",
     *     summary="xóa mùi vị",
     *     @OA\Parameter (
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="id của mùi  vị"
     *     ),
     *     @OA\Response(response=200, description="xóa thành công"),
     *     @OA\Response(response=400, description="xóa thất bại")
     * )
     */
    public function destroy($id) : ApiResponse
    {
        $result = $this->productVariantService->deleteVariant($id);
        if($result){
            return new ApiResponse(200,['message' =>'Delete success']);
        }
        return new ApiResponse(400,['message' =>'Delete fail']);
    }
}
