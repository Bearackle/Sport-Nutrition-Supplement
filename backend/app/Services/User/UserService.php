<?php

namespace App\Services\User;

use App\DTOs\InputData\UserInputUpdatePasswordData;
use App\Http\Resources\UserFullResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
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
    public function register(array $userData): JsonResponse
    {
        if(!$this->userRepository->isEmailExists($userData['email'])){
            return ApiResponse::fail('Email already used');
        }
        if(! $this->userRepository->isPhoneExists($userData['phone'])){
            return ApiResponse::fail('Phone number already used');
        }
        $userData['password'] = bcrypt($userData['password']);
        $userRegisterd = $this->userRepository->create($userData);
        $userRegisterd->assignRole('user');
        $token = $userRegisterd->createToken('access_token',['*'], Carbon::now()->addDays(3));
        $data = [
            'status' => 'success',
            'message' => 'User successfully registered',
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
            return ApiResponse::fail('Login Fail :(');
        }
        $user->tokens()->delete();
        $token = $user->createToken('access_token',['*'],Carbon::now()->
        addDays(3));
        $data = [
            'status' => 'success',
            'message' => 'Login successfully',
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
