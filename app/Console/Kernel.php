<?php

namespace App\Console;

use App\Console\Commands\MakeUserCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Laravel\Horizon\Console\TerminateCommand;
use Spatie\Mailcoach\Commands\CalculateStatisticsCommand;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        TerminateCommand::class,
        MakeUserCommand::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command(CalculateStatisticsCommand::class)->everyMinute();
        $schedule->command('email-campaigns:send-scheduled-campaigns')->everyMinute();
        $schedule->command('clean:models')->daily();
    }
}
