<?php

namespace App\Http\Controllers\Api;

use App\DTOs\InputData\ComboInputData;
use App\DTOs\InputData\ComboProductInputData;
use App\DTOs\InputData\ImageData;
use App\Http\Controllers\Controller;
use App\Http\Resources\ComboProductResource;
use App\Http\Resources\ComboResource;
use App\Http\Resources\CombosLandingMask;
use App\Http\Responses\ApiResponse;
use App\Models\Combo;
use App\Services\Combo\ComboServiceInterface;
use App\Services\ImageService\ImageProductServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ComboController extends Controller
{
    use AuthorizesRequests;
    protected ComboServiceInterface $comboService;
    protected ImageProductServiceInterface $imageProductService;
    public function __construct(ComboServiceInterface $comboService, ImageProductServiceInterface $imageProductService){
        $this->comboService = $comboService;
        $this->imageProductService = $imageProductService;
    }
    /**
     * @OA\Get(
     *     path="/api/combo/all",
     *     tags={"Combo"},
     *     description="Tìm thông tin tất cả combos",
     *     summary="Tìm thông tin tất cả combo combo",
     *     @OA\Response(response=200, description="Tìm thấy combos",@OA\JsonContent()),
     *     @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $combos = $this->comboService->getAllCombos();
        return CombosLandingMask::collection($combos);
    }
    /**
     * @OA\Post(
     *     path="/api/combo/create",
     *     tags={"Combo"},
     *     summary="Tạo combo",
     *     description="Tạo combo mới cùng với ảnh",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property (property="comboName",type="string", example="Combo Dark Test + Vitamin D3 220 viên - Combo Tăng Test, Tăng Đề Kháng"),
     *                  @OA\Property (property="description",type="string", example="ombo bao gồm :Znutrition Dark Test - Tăng Testosterone mạnh mẽ Nature Made Vitamin D3 2000iu - 220 Viên"),
     *                  @OA\Property (property="price", type="integer", example=14000000),
     *                  @OA\Property (property="comboSale", type="integer", example=15),
     *                  @OA\Property (property="categoryId", type="integer", example=1),
     *                  @OA\Property (property="image", type="string", format="binary", description="Ảnh combo (1 ảnh)")
     *              )
     *         )
     *     ),
     *     @OA\Response(response=200, description="Tạo combo thành công",@OA\JsonContent()),
     *     @OA\Response(response=500, description="Tạo combo thất bại",@OA\JsonContent())
     * )
     * @throws AuthorizationException
     */
    public function store(Request $request): ComboResource
    {
        $this->authorize('create', Combo::class);
        $combo = ComboInputData::validateAndCreate($request->input());
        $created_combo = $this->comboService->createCombo($combo);
        $this->imageProductService->addImageCombo($created_combo->combo_id, ImageData::validateAndCreate(['image' => $request->file('image')])->image);
        return new ComboResource($this->comboService->getComboById(ComboInputData::from(['combo_id' => $created_combo->combo_id])));
    }
    /**
     * @OA\Post(
     *     path="/api/combo/add",
     *     tags={"Combo"},
     *     summary="Thêm sản phẩm",
     *     description="Thêm sản phẩm vào combo",
     *     @OA\RequestBody(
     *         required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="comboId", type="integer", example=1),
     *              @OA\Property (property="productId",type="integer", example=1),
     *              @OA\Property (property="variantId", type="integer", example=1),
     *              @OA\Property (property="quantity", type="integer", example=1)
     *          )
     *     ),
     *     @OA\Response(response=200, description="Thêm sản phẩm thành công",@OA\JsonContent()),
     *     @OA\Response(response=500, description="Thêm sản phẩm thất bại",@OA\JsonContent())
     * )
     * @throws AuthorizationException
     */
    public function add(Request $request): ComboProductResource
    {
        $this->authorize('create', Combo::class);
        $product = ComboProductInputData::validateAndCreate($request->input());
        $product = $this->comboService->addProductCombo($product);
        return new ComboProductResource($product);
    }
    /**
     * @OA\Get(
     *     path="/api/combo/{id}",
     *     tags={"Combo"},
     *     description="Tìm thông tin chi tiết combo có {id}",
     *     summary="Tìm thông tin combo",
     *     @OA\Parameter (
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="id của combo"
     *     ),
     *     @OA\Response(response=200, description="Tìm thấy combo",@OA\JsonContent()),
     *     @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     */
    public function show(string $id): ComboResource
    {
        $combo_products = $this->comboService->getComboWithProducts(ComboInputData::validateAndCreate(['combo_id' => $id]));
        return new ComboResource($combo_products);
    }
    /**
     * @OA\Delete (
     *     path="/api/combo/{combo_id}",
     *     tags={"Combo"},
     *     description="xóa combo",
     *     summary="Xóa combo có {id}",
     *     @OA\Parameter(
     *         in="path",
     *         name="combo_id",
     *         required=true,
     *         description="comboId cần xóa"
     *     ),
     *     @OA\Response(response=200, description="Xóa thành công",@OA\JsonContent()),
     *     @OA\Response(response=400, description="Xóa thất bại",@OA\JsonContent()),
     *     @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     * @throws AuthorizationException
     */
    public function destroy(string $id) : ApiResponse
    {
        $this->authorize('delete', Combo::class);
        $this->comboService->destroyCombo(ComboInputData::validateAndCreate(['combo_id' => $id]));
        return new ApiResponse(200,['message' => 'delete combo successfully']);
    }
}
