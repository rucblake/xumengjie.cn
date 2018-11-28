<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Video extends Model implements Transformable
{
    use TransformableTrait;

    const PAGE_NAME = 'video_list';

    const LIST_KEY = ['*'];

    const NORMAL_VIDEO = 1;

    const P101_VIDEO = 0;

    protected $fillable = [];

}
