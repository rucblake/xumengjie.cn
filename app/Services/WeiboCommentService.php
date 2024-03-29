<?php
/**
 * Created by PhpStorm.
 * User: yangwenqing001
 * Date: 2019/3/6
 * Time: 12:17
 */

namespace App\Services;


use App\Entities\Common\Constant;
use App\Entities\WeiboUser;
use App\Exceptions\WeiboException;
use App\Libraries\HttpRequest;
use App\Libraries\Util\AesUtil;
use App\Libraries\Util\CommentsUtil;
use App\Repositories\WeiboCommentRepository;
use App\Repositories\WeiboUserRepository;
use voku\helper\HtmlDomParser;

class WeiboCommentService
{
    const CREATE_COMMENT_API = 'https://weibo.com/aj/v6/comment/add?ajwvr=6&__rnd=';
    const WEIBO_REFERER = 'https://weibo.cn';

    const RAINBOW_WEIBO_URL = 'https://weibo.cn/u/5873220619';

    const CACHE_NAME_COMMENT_URL = 'rainbow_comment_url';
    const POSTFIX = '#eland品牌代言人徐梦洁#xmj#徐梦洁哎呀好身材# @徐梦洁';

    const COMMENT_FORM_FIELD = ['srcuid', 'id', 'rl'];

    protected $weiboUserService;
    protected $weiboUserRepository;
    protected $weiboCommentRepository;

    public function __construct(WeiboUserService $weiboUserService,
                                WeiboUserRepository $weiboUserRepository,
                                WeiboCommentRepository $weiboCommentRepository)
    {
        $this->weiboUserService = $weiboUserService;
        $this->weiboUserRepository = $weiboUserRepository;
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
        if (empty($retJson)) {
            if ($user['failed_time'] > 10) {
                $this->weiboUserRepository->update(['status' => WeiboUser::USER_STATUS_MUCH_FAILURES], $user['id']);
                throw new WeiboException("comment create failed. too much failures", WeiboException::PASSPORT_FORBIDDEN);
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

    public function getCommentCount($mid = 0)
    {
        return $this->weiboCommentRepository->getCount($mid);
    }

    public function getCommentUrl($user)
    {
        try {
            $commentUrl = \Cache::get(self::CACHE_NAME_COMMENT_URL);
            if (!empty($commentUrl)) {
                return $commentUrl;
            }
            $header = [
                'Referer: ' . self::WEIBO_REFERER,
                'Cookie: ' . AesUtil::decrypt($user['cookie']),
            ];
            $response = HttpRequest::callAll(self::RAINBOW_WEIBO_URL, 'get', true, [], $header);
            $resHeader = $response['header'];
            if (strstr($resHeader, 'https://login.sina.com.cn/sso/login.php')) {
                // 登录状态过期，需要重新登录
                $this->weiboUserService->checkConfig($user);
                throw new WeiboException("get comment url failed: login status invalid", WeiboException::CONFIG_CHECK_FAILED);
            }
            $weibo = $response['body'];
            $dom = HtmlDomParser::str_get_html($weibo);
            $elements = $dom->findMulti('.c .cc');
            foreach ($elements as $element) {
                if (strstr($element->text(), '原文')) {
                    continue;
                }
                $commentNum = explode(']', explode('[', $element->text())[1])[0];
                if ($commentNum > 30000) {
                    // 如果置顶微博低于5w评论则评论置顶微博，否则评论下一条
                    continue;
                }
                $commentUrl = $element->getAttribute('href');
                break;
            }
            if (!empty($commentUrl)) {
                \Cache::put(self::CACHE_NAME_COMMENT_URL, $commentUrl, 60);
            }
            return $commentUrl;
        } catch (\Exception $e) {
            $errMsg = 'failed get weibo: ' . $e->getMessage();
            \Log::warning($errMsg);
            throw new WeiboException($errMsg, WeiboException::WEIBO_GET_ERROR);
        }
    }

    public function createCommentV2($url, $user)
    {
        try {
            $header = [
                'Referer: ' . self::WEIBO_REFERER,
                'Cookie: ' . AesUtil::decrypt($user['cookie']),
                'Content-Type: application/x-www-form-urlencoded',
            ];
            $response = HttpRequest::callAll($url, 'get', true, [], $header);
            $resHeader = $response['header'];
            if (strstr($resHeader, 'https://login.sina.com.cn/sso/login.php')) {
                // 登录状态过期，需要重新登录
                $this->weiboUserService->checkConfig($user);
                throw new WeiboException("comment failed: login status invalid", WeiboException::CONFIG_CHECK_FAILED);
            }
            $weibo = $response['body'];
            $dom = HtmlDomParser::str_get_html($weibo);
            $form = $dom->find('#cmtfrm form')[0];
            $action = $form->getAttribute('action');
            $params = [
                'content' => CommentsUtil::randomRainbowComment() . self::POSTFIX,
            ];
            foreach ($form->findMulti('input') as $input) {
                $attrs = $input->getAllAttributes();
                if (isset($attrs['name']) && in_array($attrs['name'], self::COMMENT_FORM_FIELD)) {
                    $params[$attrs['name']] = $attrs['value'];
                }
            }
            $url = self::WEIBO_REFERER . $action;
            $result = HttpRequest::callAll($url, 'post', true, $params, $header);
            if (!empty($result['body'])) {
                $context = [
                    'params' => $params,
                    'user' => $user,
                    'result' => $result,
                ];
                \Log::warning("评论返回信息", $context);
            } else {
                $record = [
                    'weibo_user_id' => $user['id'],
                    'mid' => $url,
                    'content' => $params['content'],
                ];
                $this->weiboCommentRepository->create($record);
            }
        } catch (\Exception $e) {
            if (isset(WeiboException::ERROR_MAP[$e->getCode()])) {
                throw $e;
            } else {
                $errMsg = 'failed comment: ' . $e->getMessage();
                \Log::warning($errMsg);
                throw new WeiboException($errMsg, WeiboException::COMMENT_CREATE_FAILED);
            }
        }
    }
}