<?php

namespace App\Services\User;

class AESCodeService implements AESCodeServiceInterface
{
    public function encryptAES($data){
        $key = getenv('AES_KEY');
        $iv = openssl_random_pseudo_bytes(16);
        $encrypted = openssl_encrypt($data,'AES-256-CBC',$key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv.$encrypted);
    }
    public function decryptAES($encryptedData){
        $key = getenv('AES_KEY');
        $data = base64_decode($encryptedData);
        $iv = substr($data,0,16);
        $encryted = substr($data,16);
        return openssl_decrypt($encryted, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    }
}
