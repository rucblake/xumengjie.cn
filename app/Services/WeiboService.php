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
use App\Repositories\WeiboRepository;
use Illuminate\Support\Facades\Log;

class WeiboService
{
    protected $weiboRepository;

    const WEIBO_GET_INDEX_API = 'https://m.weibo.cn/api/container/getIndex';

    const RAINBOW_UID = 5873220619;

    const RAINBOW_CONTAINER_ID = 1076035873220619;

    public function __construct(WeiboRepository $weiboRepository)
    {
        $this->weiboRepository = $weiboRepository;
    }

    public function getRainbowWeibo($id = null)
    {
        if (!empty($id)) {
            return $this->weiboRepository->find($id);
        }
        return $this->weiboRepository->getFirstWeibo(self::RAINBOW_UID);
    }

    public function updateRainbowWeibo()
    {
        $mids = $this->weiboRepository->getMidsByUid(self::RAINBOW_UID) ?? [];
        try {
            $params = [
                'type' => 'uid',
                'uid' => self::RAINBOW_UID,
                'value' => self::RAINBOW_UID,
                'containerid' => self::RAINBOW_CONTAINER_ID,
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
                    'uid' => self::RAINBOW_UID,
                    'content' => $card['mblog']['text'],
                    'release_at' => date('Y-', time()) . $card['mblog']['created_at'],
                    'weibo_url' => $card['scheme'],
                ];
                $this->weiboRepository->create($weibo);
            }
        } catch (\Exception $e) {
            $errMsg = 'failed get rainbow weibo: ' . $e->getMessage();
            Log::warning($errMsg);
            throw new WeiboException($errMsg, WeiboException::WEIBO_GET_ERROR);
        }
    }
}