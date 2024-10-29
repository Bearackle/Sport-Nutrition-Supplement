<?php

namespace App\Http\Controllers\Api;

use App\Filters\ProductFilter;
use App\Http\Requests\NewProductRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UploadImageRequest;
use App\Http\Resources\ProductLandingMask;
use App\Http\Resources\ProductResource;
use App\Http\Responses\ApiResponse;
use App\Services\ImageService\ImageProductService;
use App\Services\Product\ProductServiceInterface;
use App\Services\Product\ProductVariantServiceInterface;
use Cloudinary\Api\Exception\ApiError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ProductController
{
    protected ProductServiceInterface $productService;
    protected ProductVariantServiceInterface $productVariantService;
    protected ImageProductService $imageProductService;

    public function __construct(ProductServiceInterface $productService,ProductVariantServiceInterface $productVariantService,
                                ImageProductService $imageProductService){
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
     *                  required={"ProductName","Description","Price","Sale","StockQuantity","CategoryID", "BrandID","Images[]"},
     *                  @OA\Property(property="ProductName", format="name", example="Ostrovit Micellar Casein - 700 grams", description="Tên sản phẩm"),
     *                  @OA\Property(property="Description", example="sản phẩm số 1", description="Mô tả sản phẩm (được lưu trữ dạng html trong database)"),
     *                  @OA\Property(property="Price", format="int32", description="Giá gốc của sản phẩm",example="100000"),
     *                  @OA\Property(property="Sale", format="int32", description="tỷ lệ sale sản phẩm", example="10"),
     *                  @OA\Property(property="StockQuantity", format="int32", description="Số lượng sản phẩm (tổng tất cả các variant)",example="9"),
     *                  @OA\Property(property="CategoryID", description="Mã loại sản phẩm", format="int32",example="1"),
     *                  @OA\Property(property="BrandID", description="Mã nhãn hiệu", format="int32",example="1"),
     *                  @OA\Property(property="Images[]", type="array",
     *                              @OA\Items(type="string", format="binary"),
     *                              description="File ảnh của sản phẩm (4 ảnh)")
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
    public function store(NewProductRequest $request) : ApiResponse
    {
        $dataProductToTrans = $request->validated();
        $responseProduct = $this->productService->insertNewProduct($dataProductToTrans);
        $this->imageProductService->addImagesProduct($responseProduct['ProductID'],$request->file('Images'));
        //add default variant utility
        $this->productVariantService->insertProductVariant(['ProductID' => $responseProduct['ProductID'],
            'VariantName' => 'tasteless', 'StockQuantity' => $responseProduct['StockQuantity'],'Image' => $request->file('Images')[0]]);
        if($responseProduct){
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
         $data = $this->productService->getProductDetail($id);
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
     *              @OA\Property(property="ProductName", type="string", example="whey protein"),
     *              @OA\Property(property="Short_description", type="string", example="...."),
     *              @OA\Property(property="Description", type="string", example="..."),
     *              @OA\Property (property="Price", type="int32", example="100000"),
     *              @OA\Property (property="Sale", type="int32", example="10"),
     *              @OA\Property (property="StockQuantity", type="int32",example="100"),
     *              @OA\Property (property="CategoryID" ,type="int32",example="1"),
     *              @OA\Property (property="BrandID", type="int32", example="1")
     *          )
     *     ),
     *    @OA\Response(response=200,description="Cập nhật sản phẩm thành công"),
     *    @OA\Response(response=400,description="Cập nhật sản phẩm thất bại")
     * )
     *
     */
    public function update(UpdateProductRequest $request,string $id): ApiResponse
    {
        $dataToTrans = $request->validated();
        dd($dataToTrans);
        $result = $this->productService->updateProduct($id,$dataToTrans);
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
        $this->imageProductService->addImagesProduct($id, $request->file('Images'));
    }
    /**
     * @throws ApiError
     * @OA\Patch(
     *     path="/api/products/{id}/image",
     *     tags={"Product"},
     *     description="Cập nhật ảnh sản phẩm",
     *     summary="Cập nhật 1 ảnh của sản phẩm",
     *     @OA\Parameter (
     *         in="path",
     *         name="id",
     *         required=true
     *     ),
     *         @OA\RequestBody(
     *            required=true,
     *            @OA\MediaType(
     *                mediaType="multipart/form-data",
     *                @OA\Schema(
     *                    required={"ImageID","Image"},
     *                    @OA\Property (property="ImageID", type="integer",example="1",description="Nhập id của ảnh"),
     *                    @OA\Property(property="Image", type="string",
     *                               format="binary",
     *                                description="File ảnh của sản phẩm (1 file)")
     *                )
     *            )
     *        ),
     *     @OA\Response(response=200,description="update ảnh thành công"),
     *     @OA\Response(response=400, description="update ảnh sản phẩm thất bại")
     * )
     */
    public function updateImage(UpdateImageRequest $request,string $id)  : void    {
        $this->imageProductService->updateUploadedImage($request->input('ImageID'),
            $request->file('Image'));
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
     */
    public function destroyImage(string $image_id) : void
    {
        $image = $this->imageProductService->getImageData($image_id);
        $this->imageProductService->deleteImage($image);

    }
}
