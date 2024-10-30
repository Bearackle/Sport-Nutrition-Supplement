<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComboRequest;
use App\Http\Requests\NewProductCombo;
use App\Http\Requests\NewProductRequest;
use App\Http\Resources\ComboResource;
use App\Http\Resources\CombosLandingMask;
use App\Http\Responses\ApiResponse;
use App\Repositories\Combo\ComboRepository;
use App\Services\Combo\ComboServiceInterface;
use App\Services\ImageService\ImageProductServiceInterface;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class ComboController extends Controller
{
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
        $combos = $this->comboService->getAllCombos()->paginate(10);
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
     */
    public function store(ComboRequest $request) : ApiResponse
    {
        $data_to_trans = $request->validated();
        $created_combo = $this->comboService->createCombo($data_to_trans);
        $this->imageProductService->addImageCombo($created_combo['ComboID'],$request->file('Image'));
        return new ApiResponse(200,[$this->comboService->getComboById($created_combo->ComboID)]);
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
     */
    public function add(NewProductCombo $request) : void{
        $this->comboService->addProductCombo($request->validated());
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
       return new ApiResponse(200,[$this->comboService->getComboById($id)]);
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
    public function showProductsOfCombo($id) : ApiResponse {
        return new ApiResponse(200,[$this->comboService->getComboProducts($id)]);
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
     */
    public function destroy(string $id) : void
    {
        $this->comboService->destroyCombo($id);
    }
}
