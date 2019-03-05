<?php

namespace App\Libraries\Util;

class AesUtil
{
    protected static $key = null;

    public static function encrypt($input)
    {
        if (empty(self::$key)) {
            self::$key = env('AES_KEY');
        }
        $data = openssl_encrypt($input, 'AES-128-ECB', self::$key, OPENSSL_RAW_DATA);
        $data = base64_encode($data);
        return $data;
    }

    public static function decrypt($input)
    {
        if (empty(self::$key)) {
            self::$key = env('AES_KEY');
        }
        $decrypted = openssl_decrypt(base64_decode($input), 'AES-128-ECB', self::$key, OPENSSL_RAW_DATA);
        return $decrypted;
    }
}