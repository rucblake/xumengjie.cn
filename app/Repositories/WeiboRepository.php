<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface WeiboRepository
 * @package namespace App\Repositories;
 */
interface WeiboRepository extends RepositoryInterface
{
    public function getMidsByUid($uid);

    public function getFirstWeibo($uid);

    public function getWeibos($uid);
}
