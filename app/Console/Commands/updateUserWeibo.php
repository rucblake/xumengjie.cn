<?php

namespace App\Console\Commands;

use App\Services\WeiboService;
use Illuminate\Console\Command;

class updateUserWeibo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weibo:update {uid} {containerId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update rainbow weibo';

    protected $weiboService;

    public function __construct(WeiboService $weiboService)
    {
        $this->weiboService = $weiboService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $uid = $this->argument('uid', null);
        $containerId = $this->argument('containerId', null);
        $this->weiboService->updateUserWeibo($uid, $containerId);
        exit;
    }
}
