<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface WeiboCommentRepository
 * @package namespace App\Repositories;
 */
interface WeiboCommentRepository extends RepositoryInterface
{
    public function getCount();
}
