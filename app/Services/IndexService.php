<?php

namespace App\Services;

use App\Entities\Index;
use App\Repositories\IndexRepository;
use App\Repositories\ImageRepository;
use App\Repositories\VideoRepository;
use App\Repositories\NewsRepository;

class IndexService {

    protected $indexRepository;
    protected $imageRepository;
    protected $videoRepository;
    protected $newsRepository;

    public function __construct(
        IndexRepository $indexRepository,
        ImageRepository $imageRepository,
        VideoRepository $videoRepository,
        NewsRepository $newsRepository)
    {
        $this->indexRepository = $indexRepository;
        $this->imageRepository = $imageRepository;
        $this->videoRepository = $videoRepository;
        $this->newsRepository = $newsRepository;
    }

    public function getIndexConf()
    {
        $ret = $this->indexRepository->getIndexConf();
        return $ret;
    }

    public function getHomeData()
    {
        $ret = [];
        $ret['video']['p101'] = $this->videoRepository->getHomeData(Index::P101_TYPE, Index::P101_COUNT);
        $ret['video']['normal'] = $this->videoRepository->getHomeData(Index::NORMAL_TYPE, Index::NORMAL_COUNT);
        $ret['news'] = $this->newsRepository->getHomeData(Index::NEWS_COUNT);
        $ret['image'] = $this->imageRepository->getHomeData(Index::IMAGE_COUNT);
        return $ret;
    }
}