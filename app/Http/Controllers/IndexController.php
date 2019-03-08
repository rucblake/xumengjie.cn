<?php

namespace App\Http\Controllers;

use App\Libraries\Util\AesUtil;
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
        $homeData = $this->indexService->getHomeData();
        foreach ($conf as $item) {
            $data[$item['key']] = $item['value'];
        }
        $data['home'] = json_encode($homeData, 256);
        return view('index', $data);
    }

    public function decrypt(Request $request)
    {
        $key = $request->input('key');
        $encrypt = $request->input('encrypt');
        $decrypt = AesUtil::decryptByKey($encrypt, $key);
        return $this->response($decrypt);
    }

    public function encrypt(Request $request)
    {
        $key = $request->input('key');
        $decrypt = $request->input('decrypt');
        $encrypt = AesUtil::encryptByKey($decrypt, $key);
        return $this->response($encrypt);
    }
}
