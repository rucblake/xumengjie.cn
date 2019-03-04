<?php

namespace App\Services;

use App\Libraries\HttpRequest;
use App\Repositories\WeiboRepository;

class WeiboService
{

    const WEIBO_PASSPORT_URL = 'https://passport.weibo.cn/signin/login';
    const WEIBO_LOGIN_URL = 'https://passport.weibo.cn/sso/login';
    const WEIBO_CONFIG_URL = 'https://m.weibo.cn/api/config';

    const DEFAULT_LOGIN_PARAMS = [
        'entry' => 'mweibo',
        'res' => 'wel',
        'r' => 'https://m.weibo.cn/'
    ];

    const COOKIE_PREG = '/Set-Cookie: %s=(.*?);/m';

    const COOKIE_LIST = ['SUB', 'SUHB', 'SSOLoginState'];

    protected $weiboRepository;

    public function __construct(WeiboRepository $weiboRepository)
    {
        $this->weiboRepository = $weiboRepository;
    }

    public function autoLogin()
    {
        $loginStr = $this->getLoginStr();
        $cookies = $this->loginByPassport($loginStr);
        $status = $this->checkConfig($cookies);
        return true;
    }

    public function getLoginStr()
    {
        $result = HttpRequest::callAll(self::WEIBO_PASSPORT_URL, 'get', true, self::DEFAULT_LOGIN_PARAMS);
        $header = $result['header'];
        return $this->getResponseCookie($header, 'login');
    }

    private function getResponseCookie($header, $name)
    {
        $preg = sprintf(self::COOKIE_PREG, $name);
        if(!preg_match_all($preg, $header, $cookie)){
            throw new \Exception("cookie $name not exist in $header", 1001);
        }
        $cookie = $name . '=' . $cookie[1][0];
        return $cookie;
    }

    public function loginByPassport($loginStr)
    {
        $header = [
            'Referer: ' . self::WEIBO_PASSPORT_URL,
            'Cookie: ' . $loginStr,
        ];
        $params = [
            'username' => '18810520133',
            'password' => 'WKCywq1997,',
        ];
        $result = HttpRequest::callAll(self::WEIBO_LOGIN_URL, 'post', true, $params, $header);
        $body = json_decode($result['body'], true);
        if ($body['retcode'] != 20000000) {
            throw new \Exception("login failed: retCode is not 20000000. call result: " .
                json_encode($result, JSON_UNESCAPED_UNICODE), 1002);
        }
        $header = $result['header'];
        $cookies = $loginStr;
        foreach (self::COOKIE_LIST as $name) {
            $cookies .= ';' . $this->getResponseCookie($header, $name);
        }
        return $cookies;
    }

    public function checkConfig($cookies)
    {
        $header = [
            'Cookie: ' . $cookies,
        ];
        $result = HttpRequest::call(self::WEIBO_CONFIG_URL, 'post', true, [], $header);
        $result =  json_decode($result, true);
        if (!$result['data']['login']) {
            throw new \Exception("login failed: config login false. call result:", 1003);
        }
        return $result;
    }
}