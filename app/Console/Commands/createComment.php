<?php

namespace App\Console\Commands;

use App\Libraries\Util\AesUtil;
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

    protected $weiboUserService;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(WeiboUserService $weiboUserService)
    {
        $this->weiboUserService = $weiboUserService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = $this->weiboUserService->getNormalUser();
        foreach ($users as $user) {
            try{
                if ($user['failed_time'] > 3) {
                    continue;
                }
                if (empty($user['cookie'])) {
                    $this->weiboUserService->autoLogin($user);
                }
                $cookie = AesUtil::decrypt($user['cookie']);
                $result = $this->weiboUserService->checkConfig($cookie);
                dd($result);
            } catch (\Exception $e) {
                Log::warning($e->getMessage());
                continue;
            }

        }
    }
}
