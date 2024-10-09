<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\User\UserServiceInterface;
use App\Http\Requests\UpdatePasswordRequest;

class UserController
{
    protected $userService;
    public function __construct(UserServiceInterface $userService){
        $this->userService = $userService;
    }
    public function index()
    {
        //
    }
    public function register(RegisterRequest $request)
    {
        $result = $this->userService->register($request->validated());
        return response()->json($result);
    }
    public function login(LoginRequest $request){
        return $this->userService->login($request->validated());
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return $this->userService->profile();
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePasswordRequest $request, string $id)
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
