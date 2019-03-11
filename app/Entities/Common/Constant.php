<?php

namespace App\Entities\Common;

class Constant
{
    const INVALID_STATUS = 0;   // 无效
    const VALID_STATUS = 1;     // 有效

    const PWD_ERROR_STATUS = 2; // 用户名或密码错误
    const NEED_VERIFY_STATUS = 3; // 需要验证

    const USER_FORBIDDEN = 4; // 用户封禁

    const CURRENT_PAGE = 1;     // 默认当前页
    const PAGE_SIZE = 10;       // 默认页的size
    const MAX_PAGE_SIZE = 20;   // 最大页的size

    const APP_LOG_FORMAT = "%datetime% | [%level_name%] | %message% | %context% | %extra%\n";
}