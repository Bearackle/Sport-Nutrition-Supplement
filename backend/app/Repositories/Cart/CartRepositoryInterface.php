<?php

namespace App\Repositories\Cart;

use App\Repositories\Interfaces\RepositoryInterface;

interface CartRepositoryInterface extends RepositoryInterface{
    public function getCartIDByUser($userID);
}