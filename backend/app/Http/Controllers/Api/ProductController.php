<?php

namespace App\Http\Controllers\Api;

use App\DTOs\InputData\ImageData;
use App\DTOs\InputData\ProductIntputData;
use App\DTOs\InputData\VariantInputData;
use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewProductRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UploadImageRequest;
use App\Http\Resources\ProductLandingMask;
use App\Http\Resources\ProductResource;
use App\Http\Responses\ApiResponse;
use App\Http\Tranformers\ProductTransformer;
use App\Models\Product;
use App\Services\ImageService\ImageProductService;
use App\Services\Product\ProductServiceInterface;
use App\Services\Product\ProductVariantServiceInterface;
use Cloudinary\Api\Exception\ApiError;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Spatie\Fractal\Fractal;

class ProductController extends Controller
{
    use AuthorizesRequests;
    protected ProductServiceInterface $productService;
    protected ProductVariantServiceInterface $productVariantService;
    protected ImageProductService $imageProductService;

    /**
     */
    public function __construct(ProductServiceInterface $productService, ProductVariantServiceInterface $productVariantService,
                                ImageProductService     $imageProductService){
        $this->productService = $productService;
        $this->productVariantService = $productVariantService;
        $this->imageProductService = $imageProductService;
    }
    /**
     * Display a listing of the resource.
     * @OA\Get(
     *     path="/api/products/pages",
     *     summary="sản phẩm quan tâm nhiều",
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
     *     path="/api/collection/products",
     *     summary="lọc sản phẩm",
     *     tags={"Collection"},
     *     description="Lọc sản phẩm theo nhãn hàng (brand), giá, loại sản phẩm con",
     *     @OA\Parameter(
     *         name="params",
     *         in="query",
     *         required=false,
     *         description="Lọc sản phẩm với tiêu chí",
     *         @OA\Schema(type="object",additionalProperties=true,example={
     * "sortbyprice": "asc",
     * "category" : "1"
     * })
     *     ),
     *     @OA\Response(response=200, description="Lọc thành công"),
     *     @OA\Response(response=400, description="Lọc thất bại")
     * )
     **/
    public function filter(Request $request,ProductFilter $productFilter): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $product_filtered = $this->productService->filter($productFilter)->paginate(10);
        return ProductResource::collection($product_filtered);
    }
    /**
     * @OA\Get(
     *     path="/api/collection/category/{id}",
     *     summary="sản phẩm của một loại (category)",
     *     description="Lấy tất cả sản phẩm theo loại sản phẩm (category)",
     *     tags={"Collection"},
     *     @OA\Parameter(
     *         name="id",
     *          in="path",
     *          required=true,
     *          description="id của category",
     *          @OA\Schema(type="integer")
     *     ),
     * @OA\Response(response=200,description="Lấy sản phẩm thành công"),
     * @OA\Response(response=400,description="Không tìm thấy sản phẩm")
     * )
     */
    public function CategoryProduct($id){
        return $this->productService->getCategoryProduct($id);
    }
    /**
     * @OA\Get(
     *     path="/api/collection/all",
     *     summary="tất cả sản phẩm",
     *     tags={"Collection"},
     *     description="Lấy tất cả sản phẩm",
     *     @OA\Response(response=200, description="lấy sản phẩm thành công"),
     *     @OA\Response(response=400, description="lấy sản phẩm thất bại")
     * )
     **/
    public function allProducts(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $products = $this->productService->getProducts()->paginate(10);
        return ProductLandingMask::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     * @throws ApiError
     * @throws AuthorizationException
     * @OA\Post(
     *      path="/api/products/create",
     *      summary="Tạo một sản phẩm",
     *      tags={"Product"},
     *      security={{ "sanctum": {}}},
     *      description="Tạo sản phẩm mới gửi cùng với ảnh, lưu ý hành động này cũng sinh ra một variant mặc định tasteless",
     *      operationId="store",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  required={"ProductName","description","Price","Sale","StockQuantity","CategoryID", "BrandID","Images[]"},
     *                  @OA\Property(property="productName", format="name", example="Ostrovit Micellar Casein - 700 grams", description="Tên sản phẩm"),
     *                  @OA\Property(property="description", example="sản phẩm số 1", description="Mô tả sản phẩm (được lưu trữ dạng html trong database)"),
     *                  @OA\Property(property="price", format="int32", description="Giá gốc của sản phẩm",example="100000"),
     *                  @OA\Property(property="sale", format="int32", description="tỷ lệ sale sản phẩm", example="10"),
     *                  @OA\Property(property="stockQuantity", format="int32", description="Số lượng sản phẩm (tổng tất cả các variant)",example="9"),
     *                  @OA\Property(property="categoryId", description="Mã loại sản phẩm", format="int32",example="1"),
     *                  @OA\Property(property="brandId", description="Mã nhãn hiệu", format="int32",example="1"),
     *                  @OA\Property(property="image", type="string", format="binary",
     *                              description="File ảnh của sản phẩm (4 ảnh) phải thuộc các định dạng: .jqg, .webp, .png")
     *              )
     *          )
     *      ),
     *      @OA\Response(response=200, description="Tạo sản phẩm thành công",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="success", type="boolean", example=false),
     *              @OA\Property(property="message", type="string", example="Tạo sản phẩm thành công")
     *          )),
     *      @OA\Response(response=400, description="Tạo sản phẩm thất bại",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="fail", type="boolean", example=false),
     *              @OA\Property(property="message", type="string", example="Tạo sản phẩm thất bại")
     *          ))
     *  )
     **/
    public function store(Request $request) : ApiResponse
    {
        $this->authorize('create', Product::class);
        $product = ProductIntputData::validateAndCreate($request->input());
        $product_created = $this->productService->insertNewProduct($product);
        $this->imageProductService->addImagesProduct($product_created->product_id,[ImageData::validateAndCreate($request->file('image'))]);
        $this->productVariantService->insertDefaultTaste(VariantInputData::from($product_created));
        if($product_created){
            return new ApiResponse(200,['message' => 'Product added successfully']);
        }
        return new ApiResponse(200,['message' => 'Product not added']);
    }
    /**
     *
     * @OA\Get(
     *     path="/api/products/{id}",
     *     summary="Lấy thông tin sản phẩm",
     *     description="Lấy thông tin một sản phẩm có {id}",
     *     tags={"Product"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="id của sản phẩm cần tìm",
     *         @OA\Schema(type="integer"),
     *     ),
     * @OA\Response(response=200, description="Success"),
     * @OA\Response(response=400,description="Fail to get")
     * )
     **/
    public function show(string $id) : ApiResponse
    {
         $product = $this->productService->getProductDetail(ProductIntputData::from(['product_id' => $id]));
         $data = new ProductResource($product);
         return new ApiResponse(200,[$data]);
    }
    /**
     * @OA\Patch(
     *     path="/api/products/{id}",
     *     summary="cập nhật thông tin",
     *     tags={"Product"},
     *     description="Cập nhật thông tin product cụ thể, id của product có trong path",
     *     @OA\Parameter (
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="id của sản phẩm cần update",
     *          @OA\Schema(type="integer"),
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="productName", type="string", example="whey protein"),
     *              @OA\Property(property="shortDescription", type="string", example="...."),
     *              @OA\Property(property="description", type="string", example="..."),
     *              @OA\Property (property="price", type="integer", example=100000),
     *              @OA\Property (property="sale", type="integer", example=10),
     *              @OA\Property (property="stockQuantity", type="integer",example=100),
     *              @OA\Property (property="categoryId" ,type="=integer",example=1),
     *              @OA\Property (property="brandId", type="integer", example=1)
     *          )
     *     ),
     *    @OA\Response(response=200,description="Cập nhật sản phẩm thành công"),
     *    @OA\Response(response=400,description="Cập nhật sản phẩm thất bại")
     * )
     *
     * @throws AuthorizationException
     */
    public function update(Request $request,string $id): ApiResponse
    {
        $this->authorize('update',Product::class);
        $product = ProductIntputData::factory()->alwaysValidate()
            ->from(['product_id' => $id],$request->all());
        $result = $this->productService->updateProduct($product);
        if($result){
            return new ApiResponse(200,['message' => 'Product updated successfully']);
        }
        return new ApiResponse(200,['message' => 'Product not updated']);
    }
    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     tags={"Product"},
     *     summary="xóa sản phẩm",
     *     description="xóa sản phẩm (hành động nguy hiểm)",
     *     @OA\Parameter(
     *          name="id",
     *          required=true,
     *          in="path",
     *          description="id sản phẩm cần xóa",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200,description="xóa sản phẩm thành công"),
     *     @OA\Response(response=400, description="xóa sản phẩm thất bại")
     * )
     * @throws AuthorizationException
     */
    public function destroy(string $id): ApiResponse
    {
        $this->authorize('delete', Product::class);
        $is_success = $this->productService->deleteProduct(ProductIntputData::validateAndCreate(['product_id' => $id]));
        if($is_success){
            return new ApiResponse(200,['message' => 'Product deleted successfully']);
        }
        return new ApiResponse(200,['message' => 'Product not deleted']);
    }

    /**
     * @throws ApiError
     * @throws AuthorizationException
     * @OA\Post(
     *     path="/api/products/{id}/image",
     *     tags={"Product"},
     *     description="Thêm ảnh sản phẩm",
     *     summary="Thêm ảnh cho sản phẩm",
     *     @OA\Parameter (
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="mã sản phẩm"
     *     ),
     *     @OA\RequestBody(
     *           required=true,
     *           @OA\MediaType(
     *               mediaType="multipart/form-data",
     *               @OA\Schema(
     *                   @OA\Property(property="Images[]", type="array",
     *                               @OA\Items(type="string", format="binary"),
     *                               description="File ảnh của sản phẩm (tùy ý)")
     *               )
     *           )
     *       ),
     *     @OA\Response(response=200,description="Tải ảnh lên thành công"),
     *     @OA\Response(response=400, description="Tải ảnh lên thất bại")
     * )
     */
    public function uploadImage(UploadImageRequest $request,string $id) : void
    {
        $this->authorize('update',Product::class);
        $this->imageProductService->addImagesProduct($id, $request->file('Images'));
    }
    /**
     * @throws ApiError
     * @throws AuthorizationException
     * /**
     * /**
     * @OA\Patch(
     *      path="/api/products/image/{id}",
     *      tags={"Product"},
     *      description="Cập nhật ảnh sản phẩm",
     *      summary="Cập nhật 1 ảnh của sản phẩm",
     *      @OA\Parameter (
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema(type="integer"),
     *      ),
     *      @OA\RequestBody(
     *           required=true,
     *           @OA\MediaType(
     *               mediaType="multipart/form-data",
     *               @OA\Schema(
     *                   required={"Image"},
     *                   @OA\Property(
     *                       property="Image",
     *                       type="string",
     *                       format="binary",
     *                       description="File ảnh của sản phẩm (1 ảnh)"
     *                   )
     *               )
     *           )
     *       ),
     *      @OA\Response(response=200, description="update ảnh thành công"),
     *      @OA\Response(response=400, description="update ảnh sản phẩm thất bại"),
     *      @OA\Header(
     *          header="Content-Type",
     *          @OA\Schema(type="string", default="multipart/form-data")
     *      )
     *  )
     * /
     **/
    public function updateImage(UpdateImageRequest $request,string $id)  : void    {
        $this->authorize('update',Product::class);
        $this->imageProductService->updateUploadedImage($id,
            $request->file('image'));
    }
    /**
     * @OA\Delete(
     *     path="/api/products/image/{image_id}",
     *     tags={"Product"},
     *     summary="Xóa ảnh sản phẩm",
     *     description="Xóa 1 ảnh sản phẩm xác định",
     *     @OA\Parameter(
     *         in="path",
     *         name="image_id",
     *         required=true,
     *         description="id của ảnh"
     *     ),
     *     @OA\Response(response=200, description="Xóa ảnh thành công"),
     *     @OA\Response(response=400, description="Xóa ảnh thất bại"),
     * )
     * @throws AuthorizationException
     */
    public function destroyImage(string $image_id) : void
    {
        $this->authorize('delete',Product::class);
        $image = $this->imageProductService->getImageData($image_id);
        $this->imageProductService->deleteImage($image);
    }
    /**
     * @throws ApiError
     * @throws AuthorizationException
     * @OA\Post(
     *     path="/api/description-image",
     *     tags={"Description-image"},
     *     security={{ "sanctum": {}}},
     *     description="tạo ảnh mô tả sản phẩm mới, mỗi sản phẩm có thể có 3 (tiêu chuẩn) hoặc nhiều hơn",
     *     summary="Tạo ảnh mô tả sản phẩm",
     *     @OA\RequestBody(
     *         required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  required={"image"},
     *                  @OA\Property (property="image",type="string",format="binary",
     *                               description="File ảnh mô tả của sản phẩm, lưu ý chỉ nhận 1 file"))
     *          )
     *     ),
     * @OA\Response(response=200, description="upload ảnh thành công"),
     * @OA\Response(response=500, description="Lỗi dịch vụ")
     * )
     */
    public function uploadDescriptionImage(Request $request) : void
    {
        $this->authorize('create',Product::class);
        $request->validate(['
        image' => 'required|array|png,jpg,webp']);
        $this->imageProductService->addImageDescription($request->file('image'));
    }
    /**
     * @throws AuthorizationException
     */
    public function getAllDescriptionImages(): ApiResponse
    {
        $this->authorize('viewAny',Product::class);
        return new ApiResponse(200,[$this->imageProductService->getDescriptionsImage()]);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroyDescriptionImage(string $imageId): void
    {
        $this->authorize('delete',Product::class);
        $this->imageProductService->deleteDescriptionsImage($imageId);
    }
}
