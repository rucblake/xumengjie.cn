<?php

namespace App\Services;

use App\Entities\Common\Constant;
use App\Entities\WeiboUser;
use App\Exceptions\WeiboException;
use App\Libraries\HttpRequest;
use App\Libraries\Util\AesUtil;
use App\Repositories\WeiboUserRepository;
use Illuminate\Support\Facades\Log;

class WeiboUserService
{

    const WEIBO_PASSPORT_URL = 'https://passport.weibo.cn/signin/login';
    const WEIBO_LOGIN_URL = 'https://passport.weibo.cn/sso/login';
    const WEIBO_CONFIG_URL = 'https://m.weibo.cn/api/config';
    const WEIBO_USER_INFO_URL = 'https://m.weibo.cn/profile/info';

    const DEFAULT_LOGIN_PARAMS = [
        'entry' => 'mweibo',
        'res' => 'wel',
        'r' => 'https://m.weibo.cn/api/config'
    ];

    const COOKIE_PREG = '/Set-Cookie: %s=(.*?);/m';

    const COOKIE_LIST = ['SUB', 'SUHB', 'SSOLoginState'];

    const LOGIN_SUCCEED = '用户：%s，登录成功';

    protected $weiboUserRepository;

    public function __construct(WeiboUserRepository $weiboUserRepository)
    {
        $this->weiboUserRepository = $weiboUserRepository;
    }

    public function register($username, $password, $cookie)
    {
        $userInfo = [
            'username' => AesUtil::encrypt($username),
            'password' => AesUtil::encrypt($password),
        ];
        if (!empty($cookie)) {
            $userInfo['cookie'] = AesUtil::encrypt($cookie);
        }
        $user = $this->weiboUserRepository->findWhere(['username' => $userInfo['username']])->first();
        if (empty($user)) {
            return $this->weiboUserRepository->create($userInfo);
        }
        return $this->weiboUserRepository->update($userInfo, $user['id']);
    }

    public function login($cookie)
    {
        try {
            $user = [
                'cookie' => AesUtil::encrypt($cookie),
                'status' => WeiboUser::USER_STATUS_VALID,
                'login_at' => date('Y-m-d H:i:s', time()),
            ];
            $config = $this->checkConfig($user);
            $uid = $config['data']['uid'];
            $store = $this->weiboUserRepository->findWhere(['uid' => $uid])->first();
            if (empty($store)) {
                $info = $this->getUserInfo($uid);
                $user['uid'] = $uid;
                $user['nickname'] = $info['data']['user']['screen_name'];
                $store = $this->weiboUserRepository->create($user);
            } else {
                $info = $this->getUserInfo($uid);
                if ($store['status'] == WeiboUser::USER_STATUS_VALID) {
                    return $store;
                }
                if ($store['nickname'] != $info['data']['user']['screen_name']) {
                    $user['nickname'] = $info['data']['user']['screen_name'];
                }
                $this->weiboUserRepository->update($user, $store['id']);
            }
            return $store;
        } catch (\Exception $e) {
            throw new WeiboException("cookie登录失败", WeiboException::CONFIG_CHECK_FAILED);
        }
    }

    public function getNormalUser($id = null)
    {
        if (!empty($id)) {
            return $this->weiboUserRepository->findWhere(['id' => $id]);
        }
        return $this->weiboUserRepository->findWhere(['status' => WeiboUser::USER_STATUS_VALID]);
    }

    public function autoLogin($user)
    {
        $loginStr = $this->getLoginStr();
        $user['cookie'] = $this->loginByPassport($user, $loginStr);
        $config = $this->checkConfig($user);
        $user['uid'] = $config['data']['uid'];
        $this->saveCookie($user);
        return $user;
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
            throw new WeiboException("cookie $name not exist in $header", WeiboException::EMPTY_COOKIE);
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
        switch ($body['retcode']) {
            case 50060000:
                $this->weiboUserRepository->update(['status' => WeiboUser::USER_STATUS_VERIFY], $user['id']);
                throw new WeiboException(sprintf("login failed: need verify: errurl:%s", $body['data']['errurl']),
                    WeiboException::PASSPORT_NEED_VERIFY);
            case 50011002:
            case 50011015:
                $this->weiboUserRepository->update(['status' => WeiboUser::USER_STATUS_PASSWORD_ERROR], $user['id']);
                throw new WeiboException(sprintf("login failed: password error: username:%s, id:%s", $body['data']['username'], $user['id']),
                    WeiboException::PASSPORT_PWD_ERROR);
            case 20000000:
                break;
            default:
                throw new WeiboException("login failed: retCode is not 20000000. call result: " .
                    json_encode($body, JSON_UNESCAPED_UNICODE), WeiboException::PASSPORT_RET_ERROR);
        }
        $header = $result['header'];
        $cookie = $loginStr;
        foreach (self::COOKIE_LIST as $name) {
            $cookie .= ';' . $this->getResponseCookie($header, $name);
        }
        return AesUtil::encrypt($cookie);
    }

    public function checkConfig($user)
    {
        $header = [
            'Cookie: ' . AesUtil::decrypt($user['cookie']),
        ];
        $result = HttpRequest::call(self::WEIBO_CONFIG_URL, 'post', true, [], $header);
        $result =  json_decode($result, true);
        if (empty($result['data']['login']) || !$result['data']['login']) {
            if (!empty($user['id'])) {
                $update = [
                    'status' => WeiboUser::USER_STATUS_VERIFY,
                    'cookie' => '',
                ];
                $this->weiboUserRepository->update($update, $user['id']);
            }
            throw new WeiboException("login failed: config login false. call result:" .
                json_encode($result, JSON_UNESCAPED_UNICODE), WeiboException::CONFIG_CHECK_FAILED);
        }
        return $result;
    }

    public function saveCookie($user)
    {
        $attributes = [
            'uid' => $user['uid'],
            'cookie' => $user['cookie'],
            'login_at' => date('Y-m-d H:i:s', time()),
        ];
        $this->weiboUserRepository->update($attributes, $user['id']);
    }

    public function syncCommentCount()
    {
        $commentCount = $this->weiboUserRepository->getCommentCount();
        foreach ($commentCount as $user) {
            $user['comment_count'] = $user['weibo_comments_count'];
            unset($user['weibo_comments_count']);
            $this->weiboUserRepository->update($user, $user['id']);
        }
    }

    public function getUserInfo($uid)
    {
        $params = [
            'uid' => $uid,
        ];
        $result = HttpRequest::call(self::WEIBO_USER_INFO_URL, 'get', true, $params);
        if (empty($result)) {
            throw new WeiboException('request failed', WeiboException::REQUEST_FAILED);
        }
        return json_decode($result, true);
    }

    public function clearFailures()
    {
        $this->weiboUserRepository->clearFailures();
    }
}
