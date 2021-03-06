<?php
/**
 * Created by PhpStorm.
 * User: yangwenqing001
 * Date: 2019/3/6
 * Time: 12:17
 */

namespace App\Services;


use App\Entities\WeiboUser;
use App\Exceptions\WeiboException;
use App\Libraries\HttpRequest;
use App\Libraries\Util\AesUtil;
use App\Repositories\WeiboCommentRepository;
use App\Repositories\WeiboRepository;
use App\Repositories\WeiboUserRepository;
use Illuminate\Support\Facades\Log;

class WeiboService
{
    protected $weiboRepository;
    protected $weiboUserRepository;
    protected $weiboCommentRepository;

    const WEIBO_GET_INDEX_API = 'https://m.weibo.cn/api/container/getIndex';

    const RAINBOW_UID = 5873220619;

    const RAINBOW_CONTAINER_ID = 1076035873220619;

    public function __construct(WeiboRepository $weiboRepository,
                                WeiboUserRepository $weiboUserRepository,
                                WeiboCommentRepository $weiboCommentRepository)
    {
        $this->weiboRepository = $weiboRepository;
        $this->weiboUserRepository = $weiboUserRepository;
        $this->weiboCommentRepository = $weiboCommentRepository;
    }

    public function getUsersData()
    {
        $users = $this->weiboUserRepository->all()->toArray();
        return $this->_buildUserData($users);
    }

    public function _buildUserData(array $users = [])
    {
        $ret = [];
        foreach ($users as $user) {
            $ret[] = [
                'id' => $user['id'],
                'uid' => $user['uid'],
                'nickname' => $user['nickname'],
                'comment_count' => $user['comment_count'],
                'status' => WeiboUser::USER_STATUS_MAP[$user['status']],
                'login_at' => $user['login_at'],
            ];
        }
        return $ret;
    }
    public function getRainbowWeibo($id = null)
    {
        if (!empty($id)) {
            if ($id > 10000) {
                return $weibo = [
                    'mid' => $id,
                ];
            }
            return $this->weiboRepository->find($id);
        }
        return $this->weiboRepository->getFirstWeibo(self::RAINBOW_UID);
    }

    public function updateRainbowWeibo()
    {
        return $this->updateUserWeibo(self::RAINBOW_UID, self::RAINBOW_CONTAINER_ID);
    }

    public function getFirstWeibo($uid)
    {
        return $this->weiboRepository->getFirstWeibo($uid);
    }

    public function getWeibos($uid)
    {
        return $this->weiboRepository->getWeibos($uid);
    }

    public function updateUserWeibo($uid, $containerId)
    {
        $mids = $this->weiboRepository->getMidsByUid($uid) ?? [];
        $hasNew = false;
        try {
            $params = [
                'type' => 'uid',
                'uid' => $uid,
                'value' => $uid,
                'containerid' => $containerId,
            ];
            $result = HttpRequest::call(self::WEIBO_GET_INDEX_API, 'get', true, $params);
            $weiboData = json_decode($result, true);
            if ($weiboData['ok'] !== 1) {
                throw new WeiboException('ret code error');
            }
            foreach ($weiboData['data']['cards'] as $card) {
                if ($card['card_type'] !== 9) {
                    continue;
                }
                if (in_array($card['mblog']['mid'], $mids)) {
                    continue;
                }
                $weibo = [
                    'mid' => $card['mblog']['mid'],
                    'uid' => $uid,
                    'content' => $card['mblog']['text'],
                    'release_at' => date('Y-m-d', time()),
                    'weibo_url' => $card['scheme'],
                ];
                $this->weiboRepository->create($weibo);
                $hasNew = true;
            }
        } catch (\Exception $e) {
            $errMsg = 'failed get weibo: ' . $e->getMessage();
            Log::warning($errMsg);
            throw new WeiboException($errMsg, WeiboException::WEIBO_GET_ERROR);
        }
        return $hasNew;
    }

    public function changeWeiboStatus($id, $status)
    {
        return $this->weiboRepository->update(['status' => $status], $id);
    }
}