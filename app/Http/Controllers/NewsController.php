<?php

namespace App\Http\Controllers;

use App\Entities\Common\Constant;
use Illuminate\Http\Request;
use App\Services\NewsService;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function list(Request $request)
    {
        $currentPage = $request->input('currentPage', Constant::CURRENT_PAGE);
        $pageSize = $request->input('pageSize', Constant::PAGE_SIZE);
        $list = $this->newsService->getNewsList($currentPage, $pageSize);
        return $this->response($list);
    }
}
