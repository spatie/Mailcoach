<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Spatie\Mailcoach\Commands\CalculateStatisticsCommand;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(CalculateStatisticsCommand::class)->everyMinute();
        $schedule->command('email-campaigns:send-scheduled-campaigns')->everyMinute();
        $schedule->command('clean:models')->daily();
    }
}
