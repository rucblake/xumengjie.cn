<?php

namespace App\Http\Controllers;

use App\Entities\Common\Constant;
use App\Entities\Video;
use Illuminate\Http\Request;
use App\Services\VideoService;

class VideoController extends Controller
{
    protected $videoService;

    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    public function list(Request $request)
    {
        $currentPage = $request->input('currentPage', Constant::CURRENT_PAGE);
        $pageSize = $request->input('pageSize', Constant::PAGE_SIZE);
        $type = $request->input('type', Video::NORMAL_VIDEO);
        $list = $this->videoService->getVideoList($currentPage, $pageSize, $type);
        return $this->response($list);
    }
}
