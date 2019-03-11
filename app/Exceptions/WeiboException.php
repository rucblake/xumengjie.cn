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
}