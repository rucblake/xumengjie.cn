<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface IndexRepository
 * @package namespace App\Repositories;
 */
interface IndexRepository extends RepositoryInterface
{
    public function getIndexConf();
}
