<?php

namespace App\Console;

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
        \App\Console\Commands\ProcessPotentialCases::class,
        \App\Console\Commands\SendResumeLinkEmails::class,
        \App\Console\Commands\SendTestEmail::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(\App\Console\Commands\ProcessPotentialCases::class)
            ->everyFiveMinutes();

        $schedule->command(\App\Console\Commands\SendResumeLinkEmails::class)
            ->everyFiveMinutes();

        $schedule->command('queue:work --stop-when-empty')
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/cron.log'));
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
