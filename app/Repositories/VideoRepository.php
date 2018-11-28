<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface VideoRepository
 * @package namespace App\Repositories;
 */
interface VideoRepository extends RepositoryInterface
{
    public function getVideoList($currentPage, $pageSize, $type);
}
