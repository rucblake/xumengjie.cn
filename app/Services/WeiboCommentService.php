<?php
/**
 * Created by PhpStorm.
 * User: yangwenqing001
 * Date: 2019/3/6
 * Time: 12:17
 */

namespace App\Services;


use App\Entities\Common\Constant;
use App\Exceptions\WeiboException;
use App\Libraries\HttpRequest;
use App\Libraries\Util\AesUtil;
use App\Repositories\WeiboCommentRepository;
use App\Repositories\WeiboUserRepository;

class WeiboCommentService
{
    const CREATE_COMMENT_API = 'https://weibo.com/aj/v6/comment/add?ajwvr=6&__rnd=';
    const WEIBO_REFERER = ' https://weibo.com';

    protected $weiboCommentRepository;
    protected $weiboUserRepository;

    public function __construct(WeiboCommentRepository $weiboCommentRepository,
                                WeiboUserRepository $weiboUserRepository)
    {
        $this->weiboCommentRepository = $weiboCommentRepository;
        $this->weiboUserRepository = $weiboUserRepository;
    }

    public function createComment($user, $comment)
    {
        $header = [
            'Referer: ' . self::WEIBO_REFERER,
            'Cookie: ' . AesUtil::decrypt($user['cookie']),
        ];
        $url = self::CREATE_COMMENT_API . time();
        $retJson = HttpRequest::call($url, 'post', true, $comment, $header);
        if (empty($retJson)) {
            if ($user['failed_time'] > 3) {
                $this->weiboUserRepository->update(['status' => Constant::USER_FORBIDDEN], $user['id']);
                throw new WeiboException("comment create failed. user forbidden", WeiboException::PASSPORT_FORBIDDEN);
            }
            $this->weiboUserRepository->update(['failed_time' => $user['failed_time'] + 1], $user['id']);
            throw new WeiboException("comment create failed. request failed", WeiboException::REQUEST_FAILED);
        }
        $result =  json_decode($retJson, true);
        switch ($result['code']) {
            case 100000:
                break;
            case 100001:
                throw new WeiboException("comment create failed. create too fast", WeiboException::CREATE_TOO_FAST);
            default:
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