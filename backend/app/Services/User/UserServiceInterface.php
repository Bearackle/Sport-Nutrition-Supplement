<?php

namespace App\Services\User;

use App\DTOs\InputData\UserInputUpdatePasswordData;
use App\Models\User;
use Illuminate\Http\Request;

interface UserServiceInterface{
    public function register(array $userData);
    public function login(array $userUnAuthorized);
    public function updatePassword(User $user,UserInputUpdatePasswordData $data);
    public function profile();
}
