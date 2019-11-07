<?php

return [

    /*
     * Here you can specify which jobs should run on which queues.
     * Use an empty string to use the default queue.
     */
    'perform_on_queue' => [
        'calculate_statistics_job' => '',
        'register_click_job' => '',
        'register_open_job' => '',
        'send_campaign_job' => '',
        'send_mail_job' => '',
        'send_test_mail_job' => '',
    ],

    /*
     * By default only 5 mails per second will be sent to avoid overwhelming your
     * e-mail sending service. To use this feature you must have Redis installed.
     */
    'throttling' => [
        'enabled' => true,
        'redis_connection_name' => 'default',
        'redis_key' => 'laravel-email-campaigns',
        'allowed_number_of_jobs_in_timespan' => 5,
        'timespan_in_seconds' => 1,
        'release_in_seconds' => 1,
    ],

    /*
       * You can customize some of the behavior of this package by using our own custom action.
       * Your custom action should always extend the one of the default ones.
       */
    'actions' => [
        'personalize_html_action' => \Spatie\EmailCampaigns\Actions\PersonalizeHtmlAction::class,
        'prepare_email_html_action' => \Spatie\EmailCampaigns\Actions\PrepareEmailHtmlAction::class,
        'prepare_webview_html_action' => \Spatie\EmailCampaigns\Actions\PrepareWebviewHtmlAction::class,
        'subscribe_action' => \Spatie\EmailCampaigns\Actions\SubscribeAction::class,
        'confirm_subscription_action' => \Spatie\EmailCampaigns\Actions\ConfirmSubscriptionAction::class,
    ],

    'mailgun_feedback' => [
        'signing_secret' => env('MAILGUN_SIGNING_SECRET'),
    ],
];
