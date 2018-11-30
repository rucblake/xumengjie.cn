<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Image extends Model implements Transformable
{
    use TransformableTrait;

    const LIMIT_IMG_SIZE  = 10 * 1024 * 1024;

    const PAGE_NAME = 'video_list';

    const LIST_KEY = ['*'];

    protected $fillable = [];

}
