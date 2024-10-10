<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface{
    public function getModel(): string
    {
        return User::class;
    }
    public function isEmailExists($email): bool
    {
        return (new \App\Models\User)->where('email', $email)->doesntExist();
    }
    public function isPhoneExists($phone): bool
    {
        return (new \App\Models\User)->where('phone',$phone)->doesntExist();
    }
    public function findByEmail($email){
        return (new \App\Models\User)->where('email',$email)->first();
    }
    public function isPasswordTrue(array $user)
    {
        // TODO: Implement isPasswordTrue() method.
    }
}
