<?php

namespace App\Console\Commands\V2;

use App\Exceptions\WeiboException;
use App\Services\WeiboCommentService;
use App\Services\WeiboService;
use App\Services\WeiboUserService;
use Illuminate\Console\Command;

class commentRainbow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weibo:commentRainbow {uid?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create a comment for xmj';

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
        $result = [
            'succeedNum' => 0,
            'failedNum' => 0,
            'failedReason' => [],
        ];
        $users = $this->weiboUserService->getNormalUser($uid);
        foreach ($users as $user) {
            try {
                $commentUrl = $this->weiboCommentService->getCommentUrl($user);
                $this->weiboCommentService->createCommentV2($commentUrl, $user);
                $result['succeedNum'] ++;
                if (env('APP_ENV') === 'online') {
                    sleep(floor(60 / count($users)));
                }
            } catch (\Exception $e) {
                \Log::error($e->getMessage(), ['exception' => $e]);
                $result['failedNum'] ++;
                $result['failedReason'][$user['id']] = WeiboException::ERROR_MAP[$e->getCode()] ?? WeiboException::ERROR_MAP[WeiboException::DEFAULT_ERROR];
                continue;
            }
        }
        $end = date('Y-m-d H:i:s', time());
        echo $log = sprintf("start: %s, end: %s, result: %s \r\n", $start, $end, json_encode($result, JSON_UNESCAPED_UNICODE));
        \Log::info($log);
        exit;
    }
}
