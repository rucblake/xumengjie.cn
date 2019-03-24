<?php

namespace App\Console\Commands;

use App\Services\WeiboUserService;
use Illuminate\Console\Command;

class syncCommentCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'syncCommentCount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->weiboUserService->syncCommentCount();
        exit;
    }
}
