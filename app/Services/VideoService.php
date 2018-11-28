<?php

namespace App\Services;

use App\Libraries\Util\PageUtil;
use App\Repositories\VideoRepository;

class VideoService {

    protected $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function getVideoList($currentPage, $pageSize, $type)
    {
        $list = $this->videoRepository->getVideoList($currentPage, $pageSize, $type);
        return PageUtil::getCommonPage($list);
    }
}