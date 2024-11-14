<?php

namespace App\Services\User;

use App\DTOs\InputData\UserInputUpdatePasswordData;
use App\Http\Resources\UserFullResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\User\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    protected UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }
    public function register(array $userData): ApiResponse
    {
        if(!$this->userRepository->isEmailExists($userData['email'])){
            return new ApiResponse(409,[],'Email already used');
        }
        if(! $this->userRepository->isPhoneExists($userData['phone'])){
            return new ApiResponse(409,[],'Phone number already used');
        }
        $userData['password'] = bcrypt($userData['password']);
        $userData['is_admin'] = false;
        $userRegisterd = $this->userRepository->create($userData);
        $userRegisterd->assginRole('user');
        $success['name'] = $userRegisterd->name;
        $success['token'] = $userRegisterd->createToken('access_token')->plainTextToken;
        $success['message'] = 'Register successfully';
        return new ApiResponse(200, $success);
    }
    public function login(array $userUnAuthorized): JsonResponse
    {
        $user = $this->userRepository->findByEmail($userUnAuthorized['email']);
        if(!$user || !Hash::check($userUnAuthorized['password'],$user->password)){
            return ApiResponse::fail('Login Fail :(');
        }
        $user->tokens()->delete();
        $data = [
            'status' => 'success',
            'message' => 'Login successfully',
            'token' => $user->createToken('access_token')->plainTextToken,
            'account' => new UserResource($user)
        ];
        return response()->json($data, 200);
    }
    public function profile(): \Illuminate\Contracts\Auth\Authenticatable
    {
        return Auth::user();
    }
    public function updatePassword(User $user,UserInputUpdatePasswordData $data): JsonResponse
    {
        if(!Hash::check($data->old_password,$user->password)){
            return ApiResponse::fail( 'Old password doesn\'t match');
        }
        $result = $this->userRepository->update($user->user_id,
            ['password' => bcrypt($data->password)]);
        if(!$result){
            return ApiResponse::fail('Update fail, please try again');
        }
        $dataResponse = [
            'status' => 'success',
            'message' => 'data user updated'
        ];
        return response()->json($dataResponse, 200);
    }
}
