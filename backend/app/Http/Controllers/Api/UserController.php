<?php

namespace App\Http\Controllers\Api;

use App\Http\Responses\ApiResponse;
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
    public function index()
    {
        //
    }
    public function register(RegisterRequest $request)
    {
        return $this->userService->register($request->validated());
    }
    public function login(LoginRequest $request){
        return $this->userService->login($request->validated());
    }
    /**
     * Display the specified resource.
     */
    public function show()
    {
        return $this->userService->profile();
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePasswordRequest $request): ApiResponse
    {
        return $this->userService->updatePassword($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    //customize function start here
}
