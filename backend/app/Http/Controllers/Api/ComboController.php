<?php

namespace App\Http\Controllers\Api;

use App\DTOs\InputData\ComboInputData;
use App\DTOs\InputData\ComboProductInputData;
use App\DTOs\InputData\ImageData;
use App\Http\Controllers\Controller;
use App\Http\Requests\ComboRequest;
use App\Http\Requests\NewProductCombo;
use App\Http\Requests\NewProductRequest;
use App\Http\Resources\ComboProductResource;
use App\Http\Resources\ComboResource;
use App\Http\Resources\CombosLandingMask;
use App\Http\Resources\ProductResource;
use App\Http\Responses\ApiResponse;
use App\Models\Combo;
use App\Repositories\Combo\ComboRepository;
use App\Services\Combo\ComboServiceInterface;
use App\Services\ImageService\ImageProductServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

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
     * Display a listing of the resource.
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
     *     description="Tạo combo mới với ảnh",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  required={"ComboName","Description","Price","Cb_Sale","Image","CategoryID"},
     *                  @OA\Property (property="ComboName",type="string", example="Combo Dark Test + Vitamin D3 220 viên - Combo Tăng Test, Tăng Đề Kháng"),
     *                  @OA\Property (property="Description",type="string", example="ombo bao gồm :Znutrition Dark Test - Tăng Testosterone mạnh mẽ Nature Made Vitamin D3 2000iu - 220 Viên"),
     *                  @OA\Property (property="Price", type="integer", example=14000000),
     *                  @OA\Property (property="Cb_Sale", type="integer", example=15),
     *                  @OA\Property (property="CategoryID", type="integer", example=1),
     *                  @OA\Property (property="Image", type="string", format="binary", description="Ảnh combo (1 ảnh)")
     *              )
     *         )
     *     ),
     *     @OA\Response(response=200, description="Tạo combo thành công"),
     *     @OA\Response(response=500, description="Tạo combo thất bại")
     * )
     * @throws AuthorizationException
     */
    public function store(Request $request) : ApiResponse
    {
        $this->authorize('create', Combo::class);
        $combo = ComboInputData::validateAndCreate($request->input());
        $created_combo = $this->comboService->createCombo($combo);
        $this->imageProductService->addImageCombo($created_combo->combo_id, ImageData::validateAndCreate(['image' => $request->file('image')])->image);
        return new ApiResponse(200,[new ComboResource($this->comboService->getComboById(ComboInputData::from(['combo_id' => $created_combo->combo_id])))]);
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
     *              required={"ComboID","ProductID","VariantID","Quantity"},
     *              type="object",
     *              @OA\Property(property="ComboID", type="integer", example=1),
     *              @OA\Property (property="ProductID",type="integer", example=1),
     *              @OA\Property (property="VariantID", type="integer", example=1),
     *              @OA\Property (property="Quantity", type="integer", example=1)
     *          )
     *     ),
     *     @OA\Response(response=200, description="Thêm sản phẩm thành công"),
     *     @OA\Response(response=500, description="Thêm sản phẩm thất bại")
     * )
     * @throws AuthorizationException
     */
    public function add(Request $request): ApiResponse
    {
        $this->authorize('create', Combo::class);
        $product = $this->comboService->addProductCombo(ComboProductInputData::validateAndCreate($request->input()));
        return new ApiResponse(200, [new ComboProductResource($product)]);
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
     *     @OA\Response(response=200, description="Tìm thấy combo"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     */
    public function show(string $id) : ApiResponse
    {
        $combo = $this->comboService->getComboById(ComboInputData::validateAndCreate(['combo_id' => $id]));
       return new ApiResponse(200,[new ComboResource($combo)]);
    }
    /**
     * @OA\Get(
     *     path="/api/combo/{id}/products",
     *     tags={"Combo"},
     *     description="Tìm thông tin sản phẩm thuộc combo",
     *     summary="thông tin sản phẩm trong combo",
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="id của combo cần tìm sản phẩm",
     *     ),
     *     @OA\Response(response=200, description="Tìm sản phẩm thành công"),
     *     @OA\Response(response=400, description="Tìm sản phẩm thất bại"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     */
    public function showProductsOfCombo(string $comboId) : ApiResponse {
        $products = $this->comboService->getComboProducts(ComboInputData::validateAndCreate(['combo_id' => $comboId]));
        return new ApiResponse(200,[new ComboResource($products)]);
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
     *         description="combo_id  cần xóa"
     *     ),
     *     @OA\Response(response=200, description="Xóa thành công"),
     *     @OA\Response(response=400, description="Xóa thất bại"),
     *     @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     * @throws AuthorizationException
     */
    public function destroy(string $id) : void
    {
        $this->authorize('delete', Combo::class);
        $this->comboService->destroyCombo(ComboInputData::validateAndCreate(['combo_id' => $id]));
    }
}
