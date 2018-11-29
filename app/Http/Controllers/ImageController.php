<?php

namespace App\Http\Controllers;

use App\Entities\Common\Constant;
use App\Exceptions\ErrorException;
use Illuminate\Http\Request;
use App\Services\ImageService;

class ImageController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function list(Request $request)
    {
        $currentPage = $request->input('currentPage', Constant::CURRENT_PAGE);
        $pageSize = $request->input('pageSize', Constant::PAGE_SIZE);
        $list = $this->imageService->getImageList($currentPage, $pageSize);
        return $this->response($list);
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        if (!$file->isValid()) {
            throw new ErrorException();
        }

        $ret = $this->imageService->addSingleImage($file);
        return $this->response($ret);
    }
}
