<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('reminder:send')->dailyAt('21:00');

        // If you want to send SMS reminders, please uncomment the line below:
        // $schedule->command('sms:sendVaccinationReminders')->dailyAt('21:00');
    }
}
