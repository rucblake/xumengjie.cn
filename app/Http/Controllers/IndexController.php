<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\IndexService;

class IndexController extends Controller
{
    protected $indexService;

    public function __construct(IndexService $indexService)
    {
        $this->indexService = $indexService;
    }

    public function index(Request $request)
    {
        $data = [];
        $conf = $this->indexService->getIndexConf();
        foreach ($conf as $item) {
            $data[$item['key']] = $item['value'];
        }
        return view('index', $data);
    }
}
