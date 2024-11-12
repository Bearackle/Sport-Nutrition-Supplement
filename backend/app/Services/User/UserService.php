<?php

namespace App\Services\User;

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
    public function login(array $userUnAuthorized): ApiResponse
    {
        $user = $this->userRepository->findByEmail($userUnAuthorized['email']);
        if(!$user || !Hash::check($userUnAuthorized['password'],$user->password)){
            return new ApiResponse(401,[],'Login Fail :(');
        }
        $user->tokens()->delete();
        $data = [
            'status' => 'success',
            'message' => 'Login successfully',
            'token' => $user->createToken('access_token')->plainTextToken
        ];
        return new ApiResponse(200,$data);
    }
    public function profile(): ApiResponse
    {
        $user = Auth::user();
        return new ApiResponse(200,[$user]);
    }
    public function updatePassword(array $user){
        $userData = $this->userRepository->find($user['userid']);
        if(!Hash::check($user['password'],$userData->password)){
            return new ApiResponse(300,[],'Old password doesn\'t match');
        }
        $result = $this->userRepository->update(['password' => $user['password']],$userData->userid);
        if(!$result){
            return new ApiResponse(300,[],'Update fail, please try again');
        }
        $data = [
            'status' => 'success',
            'message' => 'updated'
        ];
        return new ApiResponse(200,$data);
    }
}
