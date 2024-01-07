<?php

namespace App\Console;

use App\Services\MailScheduleService;
use App\Services\ScheduleService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\HomeController;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $service = new ScheduleService();
        $schedule->call(fn () => $service->hourlyCron())->hourly();

        $mailing = new MailScheduleService();
        $schedule->call(fn () => $mailing->mailing())->dailyAt('8:00');

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
