<?php
/**
 * Created by PhpStorm.
 * User: yangwenqing001
 * Date: 2019/3/6
 * Time: 14:33
 */

namespace App\Exceptions;

use Exception;

class WeiboException extends Exception
{

    // 1XXX 登录错误
    const EMPTY_COOKIE = 1001;
    const PASSPORT_NEED_VERIFY = 1002;
    const PASSPORT_PWD_ERROR = 1003;
    const PASSPORT_FORBIDDEN = 1004;
    const PASSPORT_RET_ERROR = 1005;
    const CONFIG_CHECK_FAILED = 1006;

    // 2XXX 微博错误
    const WEIBO_GET_ERROR = 2001;
    const COMMENT_CREATE_FAILED = 2002;
    const CREATE_TOO_FAST = 2003;

    const REQUEST_FAILED = 9001;

    const ERROR_MAP = [
        self::EMPTY_COOKIE => 'cookie不存在',
        self::PASSPORT_NEED_VERIFY => '机器验证',
        self::PASSPORT_PWD_ERROR => '密码错误',
        self::PASSPORT_FORBIDDEN => '用户封禁',
        self::PASSPORT_RET_ERROR => '返回错误',
        self::CONFIG_CHECK_FAILED => '登录状态检查失败',
        self::WEIBO_GET_ERROR => '请求微博失败',
        self::COMMENT_CREATE_FAILED => '评论创建失败',
        self::CREATE_TOO_FAST => '评论过快',
        self::REQUEST_FAILED => '请求失败',
    ];
}