<?php
/**
 * Created by PhpStorm.
 * User: yangwenqing001
 * Date: 2019/3/6
 * Time: 12:17
 */

namespace App\Services;


use App\Exceptions\WeiboException;
use App\Libraries\HttpRequest;
use App\Libraries\Util\AesUtil;
use App\Repositories\WeiboCommentRepository;

class WeiboCommentService
{
    const CREATE_COMMENT_API = 'https://weibo.com/aj/v6/comment/add?ajwvr=6&__rnd=';
    const WEIBO_REFERER = ' https://weibo.com';

    protected $weiboCommentRepository;

    public function __construct(WeiboCommentRepository $weiboCommentRepository)
    {
        $this->weiboCommentRepository = $weiboCommentRepository;
    }

    public function createComment($user, $comment)
    {
        $header = [
            'Referer: ' . self::WEIBO_REFERER,
            'Cookie: ' . AesUtil::decrypt($user['cookie']),
        ];
        $url = self::CREATE_COMMENT_API . time();
        $retJson = HttpRequest::call($url, 'post', true, $comment, $header);
        $result =  json_decode($retJson, true);
        if ($result['code'] != 100000) {
            throw new WeiboException("comment create failed. call result:" . $retJson, WeiboException::COMMENT_CREATE_FAILED);
        }
        $record = [
            'weibo_user_id' => $user['id'],
            'mid' => $comment['mid'],
            'content' => $comment['content'],
        ];
        $this->weiboCommentRepository->create($record);
        return $retJson;
    }
}