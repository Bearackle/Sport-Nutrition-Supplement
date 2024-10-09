<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface{
    public function getModel(){
        return User::class;
    }
    public function isEmailExists($email){
        return User::where('email', $email)->doesntExist();
    }
    public function isPhoneExists($phone){
        return User::where('phone',$phone)->doesntExist();
    }
    public function findByEmail($email){
        return User::where('email',$email)->first();
    }
}