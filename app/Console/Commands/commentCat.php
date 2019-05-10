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

class commentCat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weibo:commentCat {commentUser?} {targetUser?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a comment for cat';

    protected $weiboService;
    protected $weiboUserService;
    protected $weiboCommentService;

    const STATUS_SUCCESS = 'success';
    const STATUS_FAILURE = 'failure';

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
        $commentUser = $this->argument('commentUser', null);
        $targetUser = $this->argument('targetUser', null);
        $user = $this->weiboUserService->getNormalUser($commentUser)->first();
        $weibo = $this->weiboService->getFirstWeibo($targetUser);
        try {
            if (empty($user['cookie'])) {
                $user = $this->weiboUserService->autoLogin($user);
            }
            $this->weiboUserService->checkConfig($user);
            $comment = [
                'act' => 'post',
                'uid' => $user['uid'],
                'mid' => $weibo['mid'],
                'content' => CommentsUtil::randomCatComment(),
                'forward' => 0,
                'isroot' => 0,
                'location' => 'page_100505_home',
                'module' => 'module',
                'tranandcomm' => 1,
            ];
            $this->weiboCommentService->createComment($user, $comment);
            $result['status'] = self::STATUS_SUCCESS;
        } catch (\Exception $e) {
            Log::warning($e->getMessage());
            $result['status'] = self::STATUS_FAILURE;
            $result['failedReason'] = WeiboException::ERROR_MAP[$e->getCode()];
        }
        $end = date('Y-m-d H:i:s', time());
        echo $log = sprintf("foruser: %s, start: %s, end: %s, result: %s \r\n", $targetUser, $start, $end, json_encode($result, JSON_UNESCAPED_UNICODE));
        Log::info($log);
        exit;
    }
}
