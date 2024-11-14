<?php

namespace App\Http\Controllers\Api;

use App\DTOs\InputData\UserInputUpdatePasswordData;
use App\Http\Resources\UserFullResource;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\User\UserServiceInterface;
use App\Http\Requests\UpdatePasswordRequest;

class UserController
{
    protected UserServiceInterface $userService;
    public function __construct(UserServiceInterface $userService){
        $this->userService = $userService;
    }
    /**
     *
     * @OA\Schemas  (
     *     schemes={"http","https"},
     *    @OA\Info(
     *      version="1.0",
     *      title = "Swagger UI",
     *       description = "L5 Swagger API description",
     *     @OA\Contact(
     *         name="Dinh Huan",
     *         email="dinhhuan1357@gmail.com"
     *     ),
     * )
     * )
     * @OA\SecuritySchemes(
     *      type= "http",
     *      scheme="bearer",
     *      bearerFormat: JWT
     *      name="authenticaton"
     *  )
     */
    public function index()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/account/register",
     *     summary="register new account",
     *     tags={"User"},
     *     description="Đăng ký người dùng mới",
     *     operationId="register",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  required={"name", "email","phone", "password","c_password"},
     *                  @OA\Property(property="name", format="name",example="John Doe"),
     *                  @OA\Property(property="email", format="email", example="johndoe@example.com"),
     *                  @OA\Property (property="phone", format="phone",example="0123456789"),
     *                  @OA\Property(property="password", format="password", example="your_password"),
     *                  @OA\Property (property="c_password", format="password")
     *              )
     *          )
     *      ),
     *   @OA\Response(response=200,description="successful register",@OA\JsonContent()),
     *   @OA\Response(response=401,description="fail to register",@OA\JsonContent())
     * )
     */
    public function register(RegisterRequest $request)
    {
        return $this->userService->register($request->validated());
    }
    /**
     * @OA\Post(
     *     path="/api/account/login",
     *     summary="login account",
     *     description="đăng nhập người dùng",
     *     tags={"User"},
     *     operationId="login",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *               mediaType="application/x-www-form-urlencoded",
     *               @OA\Schema(
     *                   required={"email", "password"},
     *                   @OA\Property(property="email", format="email", example="johndoe@example.com"),
     *                   @OA\Property(property="password", format="password", example="your_password"),
     *               )
     *          )
     *     ),
     *     @OA\Response(response=200, description="đăng nhập thành công",@OA\JsonContent()),
     *     @OA\Response(response=401, description="đăng nhập thất bại, vui lòng kiểm tra lại thông tin",@OA\JsonContent())
     * )
     **/
    public function login(LoginRequest $request){
        return $this->userService->login($request->validated());
    }
    /**
     * Display the specified resource.
     * @OA\Get(
     *      path="/api/account/profile",
     *      summary="hồ sơ",
     *      tags={"User"},
     *      description="Lấy thông tin hồ sơ người dùng, chỉ có user mới có thể xem",
     *   @OA\Response(response=200, description="Thông tin người dùng",@OA\JsonContent()),
     *   @OA\Response(response=401, description="Không được cấp quyền, người dùng không có bearer token phù hợp",@OA\JsonContent()),
     * )
     */
    public function show(): UserFullResource
    {
        return new UserFullResource($this->userService->profile());
    }
    /**
     * @OA\Patch(
     *      path="/api/account/reset",
     *      tags={"User"},
     *      summary="thay đổi mật khẩu",
     *      description="thay đổi mật khẩu người dùng",
     *       @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *                mediaType="application/x-www-form-urlencoded",
     *                @OA\Schema(
     *                    @OA\Property(property="oldPassword", format="password"),
     *                    @OA\Property(property="password", format="password"),
     *                    @OA\Property(property="confirmPassword", format="password"),
     *                )
     *           )
     *      ),
     *     @OA\Response(response=200, description="cập nhật thành công",@OA\JsonContent()),
     *     @OA\Response(response=400, description="cập nhật thất bại",@OA\JsonContent())
     * )
     */
    public function update(UpdatePasswordRequest $request): ApiResponse
    {
        /**@var User $user **/
        $user = auth()->user();
        $data = UserInputUpdatePasswordData::from($request->validated());
        return $this->userService->updatePassword($user,$data);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
