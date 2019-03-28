<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class WeiboUser extends Model implements Transformable
{
    use TransformableTrait;

    protected $guarded = ['id', 'create_at', 'update_at'];

    const USER_STATUS_CLOSE = 0;
    const USER_STATUS_VALID = 1;
    const USER_STATUS_PASSWORD_ERROR = 2;
    const USER_STATUS_VERIFY = 3;
    const USER_STATUS_MUCH_FAILURES = 4;
    const USER_STATUS_PROTECTED = 5;
    const USER_STATUS_EXPIRE = 6;

    const USER_STATUS_MAP = [
        self::USER_STATUS_CLOSE => '未启用',
        self::USER_STATUS_VALID => '正常',
        self::USER_STATUS_PASSWORD_ERROR => '密码错误',
        self::USER_STATUS_VERIFY => '需要手动登陆',
        self::USER_STATUS_MUCH_FAILURES => '失败过多',
        self::USER_STATUS_PROTECTED => '账户保护',
        self::USER_STATUS_PROTECTED => '登录过期',
    ];

    public function weiboComments()
    {
        return $this->hasMany(WeiboComment::class, 'weibo_user_id', 'id');
    }

}
