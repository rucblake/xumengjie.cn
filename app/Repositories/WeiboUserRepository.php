<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface WeiboUserRepository
 * @package namespace App\Repositories;
 */
interface WeiboUserRepository extends RepositoryInterface
{
    public function getCommentCount();

    public function clearFailures();
}
