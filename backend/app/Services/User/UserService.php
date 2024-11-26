<?php

namespace App\Services\User;

use App\DTOs\InputData\UserInputUpdatePasswordData;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserRepositoryInterface;
use Nette\Schema\ValidationException;

class UserService implements UserServiceInterface
{
    protected UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }
    public function register(array $userData): JsonResponse
    {
        $userData['password'] = bcrypt($userData['password']);
        $userRegisterd = $this->userRepository->create($userData);
        $userRegisterd->assignRole('user');
        $token = $userRegisterd->createToken('access_token',['*'], Carbon::now()->addDays(3));
        $data = [
            'status' => 'success',
            'message' => 'Đăng ký tài khoản thành công',
            'token' => $token->plainTextToken,
            'expiresAt' =>$token->accessToken->expires_at,
            'account' => new UserResource($userRegisterd),
        ];
        return response()->json($data);
    }
    public function login(array $userUnAuthorized): JsonResponse
    {
        $user = $this->userRepository->findByEmail($userUnAuthorized['email']);
        if(!$user || !Hash::check($userUnAuthorized['password'],$user->password)){
            return ApiResponse::fail('Đăng nhập thất bại!');
        }
        $user->tokens()->delete();
        $token = $user->createToken('access_token',['*'],Carbon::now()->
        addDays(3));
        $data = [
            'status' => 'success',
            'message' => 'Đăng nhập thành công!',
            'token' => $token->plainTextToken,
            'expiresAt' =>$token->accessToken->expires_at,
            'account' => new UserResource($user)
        ];
        return response()->json($data);
    }
    public function profile(): \Illuminate\Contracts\Auth\Authenticatable
    {
        return Auth::user();
    }
    public function updatePassword(User $user,UserInputUpdatePasswordData $data): JsonResponse
    {
        if(!Hash::check($data->current_password,$user->password)){
            return response()->json([
                'errors' => [
                    'currentPassword' => 'Mật khẩu không chính xác'
                ],
                'status' => 422],422);
        } else if($data->new_password == $data->current_password){
            return response()->json([
                'errors' =>[
                    'newPassword' => 'Mật khẩu mới không được trùng mật khẩu đang sử dụng'
                ],
                'status' => 422
            ],422);
        }
        $result = $this->userRepository->update($user->user_id,
            ['password' => bcrypt($data->new_password)]);
        if(!$result){
            return ApiResponse::fail('Cập nhật mật khẩu thất bại');
        }
        $dataResponse = [
            'message' => 'cập nhật mật khẩu thành công'
        ];
        return response()->json($dataResponse);
    }
}
