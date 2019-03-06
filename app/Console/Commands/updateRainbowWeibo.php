<?php

namespace App\Console\Commands;

use App\Services\WeiboService;
use Illuminate\Console\Command;

class updateRainbowWeibo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateRainbowWeibo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->weiboService->updateRainbowWeibo();
        exit;
    }
}
