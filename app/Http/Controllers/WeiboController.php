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
        $cookie = $request->input('cookie');
        $this->weiboUserService->register($username, $password, $cookie);
        return $this->response(true);
    }
}
