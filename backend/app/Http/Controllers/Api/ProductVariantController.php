<?php

namespace App\Http\Controllers\Api;

use App\DTOs\InputData\ImageData;
use App\DTOs\InputData\ProductIntputData;
use App\DTOs\InputData\VariantInputData;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewProductVariants;
use App\Http\Resources\VariantResource;
use App\Http\Responses\ApiResponse;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\ImageService\ImageProductServiceInterface;
use App\Services\Product\ProductVariantServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
     *     @OA\Response(response=200, description="Tìm mùi vị thành công",@OA\JsonContent()),
     *     @OA\Response(response=400, description="Tìm mùi vị thất bại",@OA\JsonContent()),
     * )
     */
    public function VariantsOfProduct($id): AnonymousResourceCollection
    {
        $data_variants = $this->productVariantService->getVariantsData(
            ProductIntputData::validateAndCreate(['product_id' => $id]));
        return VariantResource::collection($data_variants);
    }

    /**
     * @OA\Get(
     *     path="/api/products/admin/{id}/variants",
     *     tags={"Variant"},
     *     summary="Admin tìm mùi vị của sản phẩm",
     *     description="Tìm thông tin mùi vị của sản phẩm có trường stockQuantity",
     *     @OA\Parameter (
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="mã sản phẩm",
     *     ),
     *     @OA\Response(response=200, description="Tìm mùi vị thành công",@OA\JsonContent()),
     *     @OA\Response(response=400, description="Tìm mùi vị thất bại",@OA\JsonContent()),
     * )
     * @throws AuthorizationException
     */
    public function VariantsOfProductAdmin($id) : AnonymousResourceCollection
    {
        $this->authorize('viewAny', ProductVariant::class);
        $data_variants = $this->productVariantService->getVariantsData(
            ProductIntputData::validateAndCreate(['product_id' => $id]));
        return VariantResource::collection($data_variants);
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
     *            @OA\Property(property="variantName",description="Tên mùi vị",type="string",example="Milk Tea Flavor"),
     *            @OA\Property (property="productId", description="Mã sản phẩm",format="int32", example="1"),
     *            @OA\Property (property="stockQuantity", description="Số lượng sản phẩm", format="int32", example="40"),
     *            @OA\Property (property="image", description="File ảnh mùi vị", type="string", format="binary")
     *          )
     *        )
     *     ),
     *     @OA\Response(response=201,description="Tạo mùi vị thành công",@OA\JsonContent()),
     *     @OA\Response(response=400, description="Tạo mùi vị thất bại",@OA\JsonContent())
     * )
     * @throws AuthorizationException
     */
    public function store(NewProductVariants $request): VariantResource
    {
        $this->authorize('create', ProductVariant::class);
        $new_variant = $this->productVariantService->insertProductVariant(VariantInputData::validateAndCreate($request->validated()));
        $this->imageProductService->addImageVariants($new_variant->product_id, $new_variant->variant_id
            ,$request->file('image'));
        return new VariantResource($new_variant);
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
     *               @OA\Property(property="variantName", type="string", example="chocola"),
     *               @OA\Property (property="productId", type="integer"),
     *               @OA\Property (property="stockQuantity", type="integer", example=10)
     *           )
     *      ),
     *     @OA\Response(response=200,description="cập nhật thành công",@OA\JsonContent()),
     *     @OA\Response(response=400, description="cập nhật thất bại",@OA\JsonContent())
     * )
     * @throws AuthorizationException
     */
    public function update(Request $request, string $id): JsonResponse|VariantResource
    {
        $this->authorize('update', ProductVariant::class);
        $variant_updated = $this->productVariantService->updateProductVariant(VariantInputData::factory()->alwaysValidate()
            ->from($request->input(),['variant_id' => $id]));
        if(!$variant_updated){
            return ApiResponse::fail('fail update');
        }
        return new VariantResource($variant_updated);
    }

    /**
     * @OA\Post(
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
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                @OA\Property(property="image", type="string", format="binary",
     *                               description="File ảnh của sản phẩm (1 ảnh) phải thuộc các định dạng: .jqg, .webp, .png")
     *          ),
     *         )
     *     ),
     *     @OA\Response(response=200, description="Cập nhật ảnh thành công",@OA\JsonContent()),
     *     @OA\Response(response=400, description="Cập nhật ảnh thất bại",@OA\JsonContent())
     * )
     * @throws AuthorizationException
     */
    public function updateImage(Request $request,string $id) : JsonResponse {
        $this->authorize('update', ProductVariant::class);
        $this->imageProductService->updateUploadedImage($id,
            ImageData::validateAndCreate(['image' => $request->file('image')])->image);
        return ApiResponse::success('update image successully');
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
     *     @OA\Response(response=200, description="xóa thành công",@OA\JsonContent()),
     *     @OA\Response(response=400, description="xóa thất bại",@OA\JsonContent()),
     *     @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     */
    public function destroy($id) : ApiResponse
    {
        $result = $this->productVariantService->deleteVariant(VariantInputData::validateAndCreate(['variant_id' => $id]));
        if($result){
            return new ApiResponse(200,['message' =>'Delete success']);
        }
        return new ApiResponse(400,['message' =>'Delete fail']);
    }
}
