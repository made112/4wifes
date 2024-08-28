<?php

namespace App\Console;

use App\Jobs\SendListReminderDailyJob;
use App\Jobs\SendListReminderHourlyJob;
use App\Jobs\SendListReminderWeaklyJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->job(new SendListReminderHourlyJob())->dailyAt('6:00');
        $schedule->job(new SendListReminderDailyJob())->dailyAt('6:00');
        $schedule->job(new SendListReminderWeaklyJob())->weekly();

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
