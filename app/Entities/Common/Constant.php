<?php

namespace App\Entities\Common;

class Constant
{
    const INVALID_STATUS = 0;   // 无效
    const VALID_STATUS = 1;     // 有效

    const CURRENT_PAGE = 1;     // 默认当前页
    const PAGE_SIZE = 10;       // 默认页的size
    const MAX_PAGE_SIZE = 20;   // 最大页的size

    const APP_LOG_FORMAT = "%datetime% | [%level_name%] | %message% | %context% | %extra%\n";
}