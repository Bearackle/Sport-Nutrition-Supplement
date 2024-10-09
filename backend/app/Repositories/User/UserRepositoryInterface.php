<?php

namespace App\Repositories\User;

use App\Repositories\Interfaces\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface{
    public function isEmailExists($email);
    public function isPhoneExists($phone);
    public function findByEmail($email);
    public function isPasswordTrue(array $user);
}