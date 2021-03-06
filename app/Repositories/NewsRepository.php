<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface NewsRepository
 * @package namespace App\Repositories;
 */
interface NewsRepository extends RepositoryInterface
{
    public function getNewsList($currentPage, $pageSize);

    public function getHomeData($count);
}
