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
        return self::encryptByKey($input, self::$key);
    }

    public static function decrypt($input)
    {
        if (empty(self::$key)) {
            self::$key = env('AES_KEY');
        }
        return self::decryptByKey($input, self::$key);
    }

    public static function encryptByKey($input, $key)
    {
        return base64_encode(openssl_encrypt($input, 'AES-128-ECB', $key, OPENSSL_RAW_DATA));
    }

    public static function decryptByKey($input, $key)
    {
        return openssl_decrypt(base64_decode($input), 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
    }
}