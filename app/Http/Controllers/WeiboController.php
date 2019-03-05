<?php

namespace App\Http\Controllers;

use App\Services\WeiboUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WeiboController extends Controller
{

    protected $weiboUserService;

    public function __construct(WeiboUserService $weiboUserService)
    {
        $this->weiboUserService = $weiboUserService;
    }

    public function register(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        Log::info('test info', $request->all());
        Log::error('test error');
        $this->weiboUserService->register($username, $password);
        return $this->response(true);
    }
}
