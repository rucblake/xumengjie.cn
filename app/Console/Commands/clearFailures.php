<?php

namespace App\Console\Commands;

use App\Services\WeiboUserService;
use Illuminate\Console\Command;

class clearFailures extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weibo:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clear failures';

    protected $weiboUserService;

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
        $this->weiboUserService->clearFailures();
        exit;
    }
}
