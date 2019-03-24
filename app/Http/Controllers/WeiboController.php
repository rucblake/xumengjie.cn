<?php

namespace App\Http\Controllers;

use App\Services\WeiboCommentService;
use App\Services\WeiboService;
use App\Services\WeiboUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WeiboController extends Controller
{

    protected $weiboService;
    protected $weiboUserService;
    protected $weiboCommentService;

    public function __construct(WeiboService $weiboService,
                                WeiboUserService $weiboUserService,
                                WeiboCommentService $weiboCommentService)
    {
        $this->weiboService = $weiboService;
        $this->weiboUserService = $weiboUserService;
        $this->weiboCommentService = $weiboCommentService;
    }

    public function register(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $cookie = $request->input('cookie');
        $this->weiboUserService->register($username, $password, $cookie);
        return $this->response(true);
    }

    public function index(Request $request)
    {
        $users = $this->weiboService->getUsersData();
        $data = [
            'users' => json_encode($users, JSON_UNESCAPED_UNICODE),
            'count' => $this->weiboCommentService->getCommentCount(),
        ];
        return view('weibo.index', $data);
    }

    public function login(Request $request)
    {
        $cookie = $request->input('cookie');
        $user = $this->weiboUserService->login($cookie);
        return $this->response($user);
    }
}
