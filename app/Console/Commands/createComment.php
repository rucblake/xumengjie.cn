<?php

namespace App\Console\Commands;

use App\Exceptions\WeiboException;
use App\Libraries\Util\AesUtil;
use App\Libraries\Util\CommentsUtil;
use App\Services\WeiboCommentService;
use App\Services\WeiboService;
use App\Services\WeiboUserService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class createComment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weibo:create {uid?} {mid?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a comment';

    protected $weiboService;
    protected $weiboUserService;
    protected $weiboCommentService;

    const POSTFIX = '@火箭少女101_徐梦洁#徐梦洁雏菊挚爱香氛中国区推广大使##挚爱雏菊#';

    public function __construct(WeiboService $weiboService,
                                WeiboUserService $weiboUserService,
                                WeiboCommentService $weiboCommentService)
    {
        $this->weiboService = $weiboService;
        $this->weiboUserService = $weiboUserService;
        $this->weiboCommentService = $weiboCommentService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $start = date('Y-m-d H:i:s', time());
        $uid = $this->argument('uid', null);
        $mid = $this->argument('mid', null);
        $result = [
            'succeedNum' => 0,
            'failedNum' => 0,
            'failedReason' => [],
        ];
        $users = $this->weiboUserService->getNormalUser($uid);
        $weibo = $this->weiboService->getRainbowWeibo($mid);
        foreach ($users as $user) {
            $total[$user['id']] = 0;
            try {
                if (empty($user['cookie'])) {
                    $user = $this->weiboUserService->autoLogin($user);
                }
                $this->weiboUserService->checkConfig($user);
                $comment = [
                    'act' => 'post',
                    'uid' => $user['uid'],
                    'mid' => $weibo['mid'],
                    'content' => CommentsUtil::randomComment() . self::POSTFIX,
                    'forward' => 0,
                    'isroot' => 0,
                    'location' => 'page_100505_home',
                    'module' => 'module',
                    'tranandcomm' => 1,
                ];
                $this->weiboCommentService->createComment($user, $comment);
                $result['succeedNum'] ++;
                sleep(floor(240 / count($users)));
            } catch (\Exception $e) {
                Log::warning($e->getMessage());
                $result['failedNum'] ++;
                $result['failedReason'][$user['id']] = WeiboException::ERROR_MAP[$e->getCode()];
                continue;
            }
        }
        $end = date('Y-m-d H:i:s', time());
        echo $log = sprintf("start: %s, end: %s, result: %s \r\n", $start, $end, json_encode($result, JSON_UNESCAPED_UNICODE));
        Log::info($log);
        exit;
    }
}
