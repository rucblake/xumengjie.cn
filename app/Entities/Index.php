<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Index extends Model implements Transformable
{
    use TransformableTrait;

    const P101_TYPE = 0;
    const NORMAL_TYPE = 1;
    const P101_COUNT = 5;
    const NORMAL_COUNT = 5;
    const IMAGE_COUNT = 9;
    const NEWS_COUNT = 5;
    const VIDEO_TYPE = 2;
    const VIDEO_COUNT = 4;

    protected $fillable = [];

}
