<?php

namespace App\Console\Commands;

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
    protected $signature = 'createComment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a comment';

    protected $weiboService;
    protected $weiboUserService;
    protected $weiboCommentService;

    const POSTFIX = '--from xumengjie.cn';

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
        $total = [];
        $users = $this->weiboUserService->getNormalUser();
        $weibo = $this->weiboService->getRainbowWeibo();
        foreach ($users as $user) {
            $total[$user['id']] = 0;
            try {
                if ($user['failed_time'] > 3) {
                    continue;
                }
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
                $total[$user['id']] ++;
            } catch (\Exception $e) {
                Log::warning($e->getMessage());
                continue;
            }
        }
        echo sprintf("time: %s, result: %s \r\n", date('Y-m-d H:i:s', time()), json_encode($total));
        exit;
    }
}
