<?php

namespace App\Http\Controllers\Api;

use App\DTOs\InputData\ComboInputData;
use App\DTOs\InputData\ImageData;
use App\DTOs\InputData\ProductIntputData;
use App\DTOs\InputData\ReviewInputData;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Http\Responses\ApiResponse;
use App\Models\Review;
use App\Models\User;
use App\Services\Review\ReviewServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReviewController extends Controller
{
    use AuthorizesRequests;
    protected ReviewServiceInterface $reviewService;
    public function __construct(ReviewServiceInterface $reviewService){
        $this->reviewService = $reviewService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    /**
     * @OA\Post(
     *     path="/api/review",
     *     tags={"Review"},
     *     summary="tạo đánh giá",
     *     description="tạo đánh giá sản phẩm",
     *        @OA\RequestBody(
     *           required=true,
     *           @OA\MediaType(
     *               mediaType="multipart/form-data",
     *               @OA\Schema(
     *                   @OA\Property(property="productId", type="integer", example=17, description="Id sản phẩm"),
     *                   @OA\Property(property="comboId", type="integer", example=7, description="Id combo)"),
     *                   @OA\Property(property="rating", type="integer", example=5, description="điểm đánh giá"),
     *                   @OA\Property(property="comment", type="string", description="đánh giá", example="rất ngon"),
     *                   @OA\Property(
     *                      property="images[]",
     *                      type="array",
     *                      @OA\Items(type="string", format="binary"),
     *                               description="File ảnh đánh giá sản phẩm (một hoặc nhiều) phải thuộc các định dạng: .jqg, .webp, .png")
     *               )
     *           )
     *       ),
     *       @OA\Response(response=200, description="Tạo sản phẩm thành công",@OA\JsonContent()),
     *       @OA\Response(response=400, description="Tạo sản phẩm thất bại",@OA\JsonContent()),
     *       @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     * )
     * @throws AuthorizationException
     */
    public function store(Request $request) : ApiResponse
    {
        $this->authorize('create', Review::class);
        /**@var User $user**/
        $user = auth()->user();
        $createdReview = $this->reviewService->addReview(ReviewInputData::factory()->alwaysValidate()->from(['user_id' => $user->user_id],
            $request->all()));
        if($request->hasFile('images')){
            $files = $request->file('images');
            $this->reviewService->addImagestoReview(ReviewInputData::from($createdReview->toArray()), ImageData::collect(array_map(fn($file) => ['image' => $file],$files)));
        }
        return new ApiResponse(200,[$createdReview]);
    }
    /**
     * @OA\Get(
     *     path="/api/review/product/{id}",
     *     tags={"Review"},
     *     description="Tìm tất cả đánh giá của sản phẩm có {id}",
     *     summary="Tìm tất cả đánh giá của sản phẩm",
     *     @OA\Parameter(
     *          name="id",
     *           in="path",
     *           required=true,
     *           description="id của sản phẩm",
     *           @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response=200, description="Tìm thành công",@OA\JsonContent()),
     *     @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     */
    public function showProductReview(string $id): AnonymousResourceCollection
    {
        $data = ProductIntputData::validateAndCreate(['product_id' => $id]);
        $reviews = $this->reviewService->getReviewsOfProduct($data);
        return ReviewResource::collection($reviews);
    }
    /**
     * @OA\Get(
     *     path="/api/review/combo/{id}",
     *     tags={"Review"},
     *     description="Tìm tất cả đánh giá của combo có {id}",
     *     summary="Tìm tất cả đánh giá của combo",
     *     @OA\Parameter(
     *          name="id",
     *           in="path",
     *           required=true,
     *           description="id của combo",
     *           @OA\Schema(type="integer")
     *      ),
     *     @OA\Response(response=200, description="Tìm thành công",@OA\JsonContent()),
     *     @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     */
    public function showComboReview(string $id): AnonymousResourceCollection
    {
        $data = ComboInputData::validateAndCreate(['combo_id' => $id]);
        return ReviewResource::collection($this->reviewService->getReviewsOfCombo($data));
    }
    /**
     * @OA\Patch(
     *     path="/api/review/{id}",
     *     summary="cập nhật thông tin",
     *     tags={"Review"},
     *     description="Cập nhật thông tin đánh giá",
     *     @OA\Parameter (
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="id của đánh giá cần update",
     *          @OA\Schema(type="integer"),
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="rating", type="integer", example=5),
     *              @OA\Property(property="comment", type="string", example="rat tuyet voi"),
     *          )
     *     ),
     *    @OA\Response(response=200,description="Cập nhật thành công",@OA\JsonContent()),
     *    @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent()),
     *    @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent())
     * )
     *
     * @throws AuthorizationException
     */
    public function update(Request $request, string $id): JsonResponse
    {
        /**@var User $user**/
        $user = auth()->user();
        $review = ReviewInputData::factory()->alwaysValidate()->from(['review_id' => $id],$request->all());
        if($user->can('update', $this->reviewService->findReviewModel($review)))
        {
             $updatedReview = $this->reviewService->updateReview($review);
             return ApiResponse::success('update successfully');
        }
        else
        {
            throw new AuthorizationException();
        }
    }
    /**
     * @OA\Delete(
     *     path="/api/review/{id}",
     *     tags={"Review"},
     *     summary="xóa comment",
     *     description="xóa sản phẩm (hành động nguy hiểm)",
     *     @OA\Parameter(
     *          name="id",
     *          required=true,
     *          in="path",
     *          description="id review cần xóa",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200,description="xóa sản phẩm thành công",@OA\JsonContent()),
     *     @OA\Response(response=400, description="xóa sản phẩm thất bại",@OA\JsonContent()),
     *      @OA\Response(response=500, description="Lỗi dịch vụ",@OA\JsonContent()),
     * )
     * @throws AuthorizationException
     */
    public function destroy(string $id): JsonResponse
    {
        /**@var User $user**/
        $user = auth()->user();
        $review = ReviewInputData::validateAndCreate(['review_id' => $id]);
        if($user->can('delete', $this->reviewService->findReviewModel($review)))
        {
            $this->reviewService->deleteReview($review);
            return ApiResponse::success('delete successfully');
        }
        else
        {
            throw new AuthorizationException();
        }
    }
    /**
     * @throws AuthorizationException
     * @OA\Post(
     *     path="/api/review/image",
     *     tags={"Review"},
     *     description="Thêm ảnh cho đánh giá",
     *     summary="Thêm ảnh đánh giá",
     *     @OA\RequestBody(
     *           required=true,
     *           @OA\MediaType(
     *               mediaType="multipart/form-data",
     *               @OA\Schema(
     *                   @OA\Property(property="reviewId", type="integer", format="int32", description="reviewId của đánh giá cần upload ảnh"),
     *                      @OA\Property(
     *                       property="images[]",
     *                       type="array",
     *                       @OA\Items(type="string", format="binary"),
     *                                description="File ảnh đánh giá sản phẩm (một hoặc nhiều) phải thuộc các định dạng: .jqg, .webp, .png"),
     *               )
     *           )
     *       ),
     *     @OA\Response(response=200,description="Tải ảnh lên thành công",@OA\JsonContent()),
     *     @OA\Response(response=400, description="Tải ảnh lên thất bại",@OA\JsonContent()),
     *     @OA\Response(response=422, description="Sai định dạng yêu cầu",@OA\JsonContent())
     * )
     */
    public function addImage(Request $request) :  ApiResponse{
        /**@var User $user**/
        $user = auth()->user();
        $review = $this->reviewService->findReviewModel(ReviewInputData::validateAndCreate(['review_id' => $request->input('reviewId')]));
        if($user->can('update', $review)) {
            $files = $request->file('images');
            $this->reviewService->addImagestoReview(ReviewInputData::from($review->toArray()), ImageData::collect(array_map(fn($file) => ['image' => $file], $files)));
            return new ApiResponse(200, ['message' => 'add image successfully']);
        }
        return new ApiResponse(400,[],'add image failed :(');
    }
    /**
     * @OA\Delete(
     *     path="/api/review/image/{id}",
     *     tags={"Review"},
     *     summary="Xóa ảnh đánh giá",
     *     description="Xóa 1 ảnh của review",
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
     */
    public function destroyImage(string $id): JsonResponse
    {
        $this->reviewService->deleteImageReview($id);
        return ApiResponse::success('delete review image successfully');
    }
}
