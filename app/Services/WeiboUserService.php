<?php

namespace App\Services;

use App\Entities\Common\Constant;
use App\Libraries\HttpRequest;
use App\Libraries\Util\AesUtil;
use App\Repositories\WeiboUserRepository;
use Illuminate\Support\Facades\Log;

class WeiboUserService
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

    protected $weiboUserRepository;

    public function __construct(WeiboUserRepository $weiboUserRepository)
    {
        $this->weiboUserRepository = $weiboUserRepository;
    }

    public function register($username, $password)
    {
        $userInfo = [
            'username' => AesUtil::encrypt($username),
            'password' => AesUtil::encrypt($password),
        ];
        $user = $this->weiboUserRepository->findWhere(['username' => $userInfo['username']])->first();
        if (empty($user)) {
            return $this->weiboUserRepository->create($userInfo);
        }
        return $this->weiboUserRepository->update($userInfo, $user['id']);
    }

    public function getNormalUser()
    {
        return $this->weiboUserRepository->findWhere(['status' => Constant::VALID_STATUS]);
    }

    public function autoLogin($user)
    {
        $loginStr = $this->getLoginStr();
        $cookie = $this->loginByPassport($user, $loginStr);
        if ($this->checkConfig($cookie)) {
            $this->saveCookie($user['id'], $cookie);
            return true;
        }
        return false;
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

    public function loginByPassport($user, $loginStr)
    {
        $header = [
            'Referer: ' . self::WEIBO_PASSPORT_URL,
            'Cookie: ' . $loginStr,
        ];
        $params = [
            'username' => AesUtil::decrypt($user['username']),
            'password' => AesUtil::decrypt($user['password']),
        ];
        $result = HttpRequest::callAll(self::WEIBO_LOGIN_URL, 'post', true, $params, $header);
        $body = json_decode($result['body'], true);
        if ($body['retcode'] != 20000000) {
            throw new \Exception("login failed: retCode is not 20000000. call result: " .
                json_encode($result, JSON_UNESCAPED_UNICODE), 1002);
        }
        $header = $result['header'];
        $cookie = $loginStr;
        foreach (self::COOKIE_LIST as $name) {
            $cookie .= ';' . $this->getResponseCookie($header, $name);
        }
        return $cookie;
    }

    public function checkConfig($cookie)
    {
        $header = [
            'Cookie: ' . $cookie,
        ];
        $result = HttpRequest::call(self::WEIBO_CONFIG_URL, 'post', true, [], $header);
        $result =  json_decode($result, true);
        if (!$result['data']['login']) {
            throw new \Exception("login failed: config login false. call result:" .
                json_encode($result, JSON_UNESCAPED_UNICODE), 1003);
        }
        return $result;
    }

    public function saveCookie($id, $cookie)
    {
        $cookie = AesUtil::encrypt($cookie);
        $attributes = [
            'cookie' => $cookie,
            'login_at' => date('Y-m-d H:i:s', time()),
        ];
        $this->weiboUserRepository->update($attributes, $id);
    }

    public function loginFailed($user)
    {
        $attributes = [
            'cookie' => '',
            'login_at' => '',
            'failed_time' => $user['failed_time'] + 1,
        ];
        $this->weiboUserRepository->update($attributes, $user['id']);
    }
}