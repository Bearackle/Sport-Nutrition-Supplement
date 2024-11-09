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
use App\Services\Review\ReviewService;
use App\Services\Review\ReviewServiceInterface;
use Cloudinary\Api\Exception\ApiError;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

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
     *                      property="image",
     *                      type="array",
     *                      @OA\Items(type="string", format="binary"),
     *                               description="File ảnh đánh giá sản phẩm (một hoặc nhiều) phải thuộc các định dạng: .jqg, .webp, .png")
     *               )
     *           )
     *       ),
     *       @OA\Response(response=200, description="Tạo sản phẩm thành công"),
     *       @OA\Response(response=400, description="Tạo sản phẩm thất bại"),
     *       @OA\Response(response=422, description="Sai định dạng yêu cầu")
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
     * Display the specified resource.
     */
    public function showProductReview(string $id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $data = ProductIntputData::validateAndCreate(['product_id' => $id]);
        $reviews = $this->reviewService->getReviewsOfProduct($data);
        return ReviewResource::collection($reviews);
    }
    public function showComboReview(string $id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $data = ComboInputData::validateAndCreate(['combo_id' => $id]);
        return ReviewResource::collection($this->reviewService->getReviewsOfCombo($data));
    }
    /**
     * Update the specified resource in storage.
     * @throws AuthorizationException
     */
    public function update(Request $request, string $id) : ApiResponse
    {
        /**@var User $user**/
        $user = auth()->user();
        $review = ReviewInputData::factory()->alwaysValidate()->from(['review_id' => $id],$request->all());
        if($user->can('update', $this->reviewService->findReviewModel($review)))
        {
             $updatedReview = $this->reviewService->updateReview($review);
             return new ApiResponse(200,[new ReviewResource($updatedReview)]);
        }
        else
        {
            throw new AuthorizationException();
        }
    }
    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(string $id) : void
    {
        /**@var User $user**/
        $user = auth()->user();
        $review = ReviewInputData::validateAndCreate(['review_id' => $id]);
        if($user->can('delete', $this->reviewService->findReviewModel($review)))
        {
            $this->reviewService->deleteReview($review);
        }
        else
        {
            throw new AuthorizationException();
        }
    }
    /**
     * @throws ApiError
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
    public function destroyImage(string $id) : void{
        $this->reviewService->deleteImageReview($id);
    }
}
