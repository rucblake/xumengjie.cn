<?php

namespace App\Console;

use App\Console\Commands\clearFailures;
use App\Console\Commands\comment;
use App\Console\Commands\commentRainbow;
use App\Console\Commands\syncCommentCount;
use App\Console\Commands\updateRainbowWeibo;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        commentRainbow::class,
        updateRainbowWeibo::class,
        syncCommentCount::class,
        clearFailures::class,
        comment::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
