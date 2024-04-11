<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('mailcoach:send-automation-mails')->everyMinute();
Schedule::command('mailcoach:send-scheduled-campaigns')->everyMinute();
Schedule::command('mailcoach:send-campaign-mails')->everyMinute();

Schedule::command('mailcoach:run-automation-triggers')->everyMinute();
Schedule::command('mailcoach:run-automation-actions')->everyMinute();

Schedule::command('mailcoach:calculate-statistics')->everyMinute();
Schedule::command('mailcoach:calculate-automation-mail-statistics')->everyMinute();
Schedule::command('mailcoach:calculate-transactional-statistics')->everyMinute();
Schedule::command('mailcoach:send-campaign-summary-mail')->hourly();
Schedule::command('mailcoach:cleanup-processed-feedback')->hourly();
Schedule::command('mailcoach:send-email-list-summary-mail')->mondays()->at('9:00');
Schedule::command('mailcoach:delete-old-unconfirmed-subscribers')->daily();

Schedule::command('horizon:snapshot')->everyFiveMinutes();
