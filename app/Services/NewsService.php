<?php

namespace App\Services;

use App\Libraries\Util\PageUtil;
use App\Repositories\NewsRepository;

class NewsService {

    protected $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getNewsList($currentPage, $pageSize)
    {
        $list = $this->newsRepository->getNewsList($currentPage, $pageSize);
        return PageUtil::getCommonPage($list);
    }
}