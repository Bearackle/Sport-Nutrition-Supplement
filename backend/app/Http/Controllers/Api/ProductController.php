<?php

namespace App\Http\Controllers\Api;

use App\DTOs\InputData\CategoryInputData;
use App\DTOs\InputData\ImageData;
use App\DTOs\InputData\ProductIntputData;
use App\DTOs\InputData\VariantInputData;
use App\Filters\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Resources\CombosLandingMask;
use App\Http\Resources\ImageResource;
use App\Http\Resources\ProductLandingMask;
use App\Http\Resources\ProductResource;
use App\Http\Responses\ApiResponse;
use App\Models\Product;
use App\Services\ImageService\ImageProductService;
use App\Services\Product\ProductServiceInterface;
use App\Services\Product\ProductVariantServiceInterface;
use Cloudinary\Api\Exception\ApiError;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
     *     @OA\Response(response=200,description="Lấy sản phẩm thành công",@OA\JsonContent()),
     *     @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent()),
     *     @OA\Response(response=400, description="Lỗi mạng",@OA\JsonContent())
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
     * "category" : "1",
     * "price" : "(>=700000AND<=900000)"
     * })
     *     ),
     *     @OA\Response(response=200, description="Lọc thành công",@OA\JsonContent()),
     *     @OA\Response(response=400, description="Lọc thất bại",@OA\JsonContent()),
     *     @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     * )
     **/
    public function filter(Request $request,ProductFilter $productFilter): AnonymousResourceCollection
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
     * @OA\Response(response=200,description="Lấy sản phẩm thành công",@OA\JsonContent()),
     * @OA\Response(response=400,description="Không tìm thấy sản phẩm",@OA\JsonContent()),
     * @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     * )
     */
    public function CategoryProduct($id): AnonymousResourceCollection
    {
        $products = $this->productService->getCategoryProduct(CategoryInputData::from(['category_id' => $id]));
        return ProductResource::collection($products);
    }
    /**
     * @OA\Get(
     *     path="/api/collection/all",
     *     summary="tất cả sản phẩm",
     *     tags={"Collection"},
     *     description="Lấy tất cả sản phẩm",
     *     @OA\Response(response=200, description="lấy sản phẩm thành công",@OA\JsonContent()),
     *     @OA\Response(response=400, description="lấy sản phẩm thất bại",@OA\JsonContent()),
     *     @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     * )
     **/
    public function allProducts(): AnonymousResourceCollection
    {
        $products = $this->productService->getProducts();
        return ProductLandingMask::collection($products);
    }
    /**
     * Store a newly created resource in storage.
     * @throws AuthorizationException
     * @OA\Post(
     *      path="/api/products/create",
     *      summary="Tạo một sản phẩm",
     *      tags={"Product"},
     *      description="Tạo sản phẩm mới gửi cùng với ảnh, lưu ý hành động này cũng sinh ra một variant mặc định tasteless",
     *      operationId="store",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  @OA\Property(property="productName", format="name", example="Ostrovit Micellar Casein - 700 grams", description="Tên sản phẩm"),
     *                  @OA\Property(property="shortDescription", example="chứa nhiều protein", description="Mô tả sản phẩm ngắn"),
     *                  @OA\Property(property="description", example="sản phẩm số 1", description="Mô tả sản phẩm (được lưu trữ dạng html trong database)"),
     *                  @OA\Property(property="price", format="int32", description="Giá gốc của sản phẩm",example="100000"),
     *                  @OA\Property(property="sale", format="int32", description="tỷ lệ sale sản phẩm", example="10"),
     *                  @OA\Property(property="stockQuantity", format="int32", description="Số lượng sản phẩm (tổng tất cả các variant)",example="9"),
     *                  @OA\Property(property="categoryId", description="Mã loại sản phẩm", format="int32",example="1"),
     *                  @OA\Property(property="brandId", description="Mã nhãn hiệu", format="int32",example="1"),
     *                  @OA\Property(property="image", type="string", format="binary",
     *                              description="File ảnh của sản phẩm (1 ảnh) phải thuộc các định dạng: .jqg, .webp, .png")
     *              )
     *          )
     *      ),
     *      @OA\Response(response=200, description="Tạo sản phẩm thành công",@OA\JsonContent()),
     *      @OA\Response(response=400, description="Tạo sản phẩm thất bại",@OA\JsonContent()),
     *      @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     *  )
     **/
    public function store(Request $request): JsonResponse
    {
        $this->authorize('create', Product::class);
        $product = ProductIntputData::validateAndCreate($request->input());
        $productCreated = $this->productService->insertNewProduct($product);
        $this->imageProductService->addImagesProduct($productCreated->product_id,[ImageData::validateAndCreate(['image' => $request->file('image')])->image]);
        $variantCreated = $this->productVariantService->insertDefaultTaste(VariantInputData::from($productCreated));
        $this->imageProductService->addImageVariants($productCreated->product_id, $variantCreated->variant_id,$request->file('image'));
        return ApiResponse::success('Product added successfully');
    }
    /**
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
     * @OA\Response(response=200, description="Success",@OA\JsonContent()),
     * @OA\Response(response=400,description="Fail to get",@OA\JsonContent()),
     * @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     * )
     **/
    public function show(string $id): ProductResource
    {
         $product = $this->productService->getProductDetail(ProductIntputData::validateAndCreate(['product_id' => $id]));
         return new ProductResource($product);
    }

    /**
     * @param string $id
     * @return ProductResource
     * @OA\Get(
     *     path="/api/products/admin/{id}",
     *     tags={"Product"},
     *     summary="Admin Tìm thông tin sản phẩm",
     *     description="Admin tìm thông tin sản phẩm, trường stockQuantity sẽ có giá trị",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="id của sản phẩm cần tìm",
     *          @OA\Schema(type="integer"),
     *      ),
     *  @OA\Response(response=200, description="Success",@OA\JsonContent()),
     *  @OA\Response(response=400,description="Fail to get",@OA\JsonContent()),
     *  @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     * )
     */
    public function showProductsAdmin(string $id) : ProductResource
    {
        $product = $this->productService->getProductDetail(ProductIntputData::validateAndCreate(['product_id' => $id]));
        return new ProductResource($product);
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
     *    @OA\Response(response=200,description="Cập nhật sản phẩm thành công",@OA\JsonContent()),
     *    @OA\Response(response=400,description="Cập nhật sản phẩm thất bại",@OA\JsonContent()),
     *     @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     * )
     *
     * @throws AuthorizationException
     */
    public function update(Request $request,string $id)
    {
        $this->authorize('update',Product::class);
        $product = ProductIntputData::factory()->alwaysValidate()->from(['product_id' => $id],
            $request->all());
        $result = $this->productService->updateProduct($product);
        if($result){
            return ApiResponse::success('Product updated successfully');
        }
        return ApiResponse::success('Product not updated');
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
     *     @OA\Response(response=200,description="xóa sản phẩm thành công",@OA\JsonContent()),
     *     @OA\Response(response=400, description="xóa sản phẩm thất bại",@OA\JsonContent()),
     *      @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     * )
     * @throws AuthorizationException
     */
    public function destroy(string $id): JsonResponse
    {
        $this->authorize('delete', Product::class);
        $is_success = $this->productService->deleteProduct(ProductIntputData::validateAndCreate(['product_id' => $id]));
        if($is_success){
            return  ApiResponse::success('Product deleted successfully');
        }
        return ApiResponse::fail('Product not deleted');
    }
    /**
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
     *                   @OA\Property(property="image", type="string", format="binary", description="File ảnh của sản phẩm (1 ảnh)")
     *               )
     *           )
     *       ),
     *     @OA\Response(response=200,description="Tải ảnh lên thành công",@OA\JsonContent()),
     *     @OA\Response(response=400, description="Tải ảnh lên thất bại",@OA\JsonContent()),
     *      @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     * )
     */
    public function uploadImage(Request $request,string $id): JsonResponse
    {
        $this->authorize('update',Product::class);
        $this->imageProductService->addImagesProduct($id,
            [ImageData::validateAndCreate(['image' => $request->file('image')])->image]);
        return ApiResponse::success('image add successfully');
    }
    /**
     * @throws ApiError
     * @throws AuthorizationException
     * /**
     * /**
     * /**
     * @OA\Post(
     *      path="/api/products/image/{id}",
     *      tags={"Product"},
     *      description="Cập nhật ảnh sản phẩm",
     *      summary="Cập nhật 1 ảnh của sản phẩm",
     *      @OA\Parameter (
     *          in="path",
     *          name="id",
     *          required=true,
     *          description="mã ảnh sản phẩm",
     *      @OA\Schema(type="integer"),
     *     ),
     *      @OA\RequestBody(
     *          required=true,
     *          content={
     *                  @OA\MediaType(
     *                      mediaType="multipart/form-data",
     *                      @OA\Schema(
     *                          @OA\Property(
     *                              property="image",
     *                              type="string",
     *                              format="binary"
     * )
     * )
     * )
     * }
     * ),
     * @OA\Response(response=200, description="update ảnh thành công",@OA\JsonContent()),
     * @OA\Response(response=400, description="update ảnh sản phẩm thất bại",@OA\JsonContent()),
     * @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     * )
     * /
     **/
    public function updateImage(UpdateImageRequest $request,string $id): JsonResponse
    {
        $this->authorize('update',Product::class);
        $this->imageProductService->updateUploadedImage($id,
            ImageData::validateAndCreate(['image' => $request->file('image')])->image);
        return ApiResponse::success('image update successully');
    }
    /**
     * @OA\Delete(
     *     path="/api/products/image/{id}",
     *     tags={"Product"},
     *     summary="Xóa ảnh sản phẩm",
     *     description="Xóa 1 ảnh sản phẩm xác định",
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="id của ảnh"
     *     ),
     *     @OA\Response(response=200, description="Xóa ảnh thành công",@OA\JsonContent()),
     *     @OA\Response(response=400, description="Xóa ảnh thất bại",@OA\JsonContent()),
     *     @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     * )
     * @throws AuthorizationException
     */
    public function destroyImage(string $image_id): JsonResponse
    {
        $this->authorize('delete',Product::class);
        $image = $this->imageProductService->getImageData($image_id);
        $this->imageProductService->deleteImage($image);
        return ApiResponse::success('destroy image successfully');
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
     * @OA\Response(response=200, description="upload ảnh thành công",@OA\JsonContent()),
     * @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent()),
     *  @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     * )
     */
    public function uploadDescriptionImage(Request $request): ImageResource
    {
        $this->authorize('create',Product::class);
        $image = $this->imageProductService->addImageDescription(ImageData::validateAndCreate(['image' => $request->file('image')])->image);
        return new ImageResource($image);
    }
    /**
     * @throws AuthorizationException
     * @OA\Get(
     *     path="/api/description-image",
     *     tags={"Description-image"},
     *     description="Tìm toàn bộ ảnh description",
     *     summary="Tìm ảnh mô tả sản phẩm",
     *   @OA\Response(response=200, description="Tìm ảnh thành công",@OA\JsonContent()),
     *   @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent()),
     *    @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     * )
     */
    public function getAllDescriptionImages(): AnonymousResourceCollection
    {
        $this->authorize('viewAny',Product::class);
        $images = $this->imageProductService->getDescriptionsImage();
        return ImageResource::collection($images);
    }
    /**
     * @throws AuthorizationException
     * @OA\Delete(
     *     path="/api/description-image/{id}",
     *     tags={"Description-image"},
     *     description="Xóa 1 ảnh mô tả sản phẩm",
     *     summary="xóa ảnh mô tả sản phẩm",
     *     @OA\Parameter (
     *         in="path",
     *         name="id",
     *         required=true,
     *         description="Xóa ảnh mô tả sản phẩm"
     *      ),
     *     @OA\Response(response=200, description="Xóa ảnh thành công",@OA\JsonContent()),
     *     @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent()),
     *     @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     * )
     */
    public function destroyDescriptionImage(string $imageId): JsonResponse
    {
        $this->authorize('delete',Product::class);
        $this->imageProductService->deleteDescriptionsImage($imageId);
        return ApiResponse::success('delete description image successfully');
    }
    /**
     * @OA\Get (
     *     path="/api/collection/search",
     *     tags={"Collection"},
     *     description="Tìm sản phẩm có tên gần giống tham số",
     *     summary="Tìm sản phẩm",
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=false,
     *         description="Tìm sản phẩm có tên gần giống",
     *         @OA\Schema(
     *             type="string",
     *             example="casei"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tìm thành công"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Lỗi dịch vụ"
     *     )
     * )
     */
    public function search(Request $request): AnonymousResourceCollection
    {
        $data = $this->productService->search($request->input('name'));
        return ProductLandingMask::collection($data);
    }
}
