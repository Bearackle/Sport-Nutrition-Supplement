<?php

namespace App\Services\User;

interface AESCodeServiceInterface
{
    public function encryptAES($data);
    public function decryptAES($encryptedData);
}
