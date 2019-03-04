<?php
/**
 * Created by PhpStorm.
 * User: wujianqiang
 * Date: 2018/6/11
 * Time: 20:15
 */

namespace App\Libraries;

class HttpRequest
{
    const TIMEOUT     = 2;
    const METHOD_POST = 'post';
    const METHOD_GET  = 'get';

    public static function commonSet($url, $method, $isHttps, $params, $headers)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, self::TIMEOUT);
        if($isHttps) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }

        $queryString = '';
        if ($params) {
            $queryString = http_build_query($params);
        }
        if (strtolower($method) == self::METHOD_POST) {
            curl_setopt($ch, CURLOPT_POST, true);
            if ($queryString) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $queryString);
            }
        } else {
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            if ($queryString) {
                $url .= '?' . $queryString;
            }
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        return $ch;
    }

    public static function call($url, $method = 'GET', $isHttps = false, $params = [], $headers = [])
    {
        $ch = self::commonSet($url, $method, $isHttps, $params, $headers);
        return curl_exec($ch);
    }

    public static function callAll($url, $method = 'GET', $isHttps = false, $params = [], $headers = [])
    {
        // 返回响应header
        $ch = self::commonSet($url, $method, $isHttps, $params, $headers);
        curl_setopt($ch, CURLOPT_HEADER,1);
        $result = curl_exec($ch);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

        $ret = [
            'header' => substr($result, 0, $headerSize),
            'body' => substr($result, $headerSize),
        ];
        return $ret;
    }
}