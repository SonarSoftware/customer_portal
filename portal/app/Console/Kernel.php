<?php

namespace App\Console;

use App\Console\Commands\DeleteExpiredTokens;
use App\Console\Commands\TestPayPalCredentials;
use App\Console\Commands\TestSmtpCredentials;
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
        TestSmtpCredentials::class,
        TestPayPalCredentials::class,
        DeleteExpiredTokens::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command("sonar:deleteexpiredtokens")->hourly()->withoutOverlapping();
    }
}
