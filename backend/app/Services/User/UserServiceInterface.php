<?php

namespace App\Services\User;

use Illuminate\Http\Request;

interface UserServiceInterface{
    public function register(array $userData);
    public function login(array $userUnAuthorized);
    public function profile();  
}