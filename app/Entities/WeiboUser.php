<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class WeiboUser extends Model implements Transformable
{
    use TransformableTrait;

    protected $guarded = ['id', 'create_at', 'update_at'];

}
