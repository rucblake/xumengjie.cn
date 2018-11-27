<?php

namespace App\Services;

use App\Repositories\IndexRepository;

class IndexService {

    protected $indexRepository;

    public function __construct(IndexRepository $indexRepository)
    {
        $this->indexRepository = $indexRepository;
    }

    public function getIndexConf()
    {
        $ret = $this->indexRepository->getIndexConf();
        return $ret;
    }
}