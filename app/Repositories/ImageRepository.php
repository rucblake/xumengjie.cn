<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ImageRepository
 * @package namespace App\Repositories;
 */
interface ImageRepository extends RepositoryInterface
{
    public function getImageList($currentPage, $pageSize);

    public function getHomeData($count);
}
