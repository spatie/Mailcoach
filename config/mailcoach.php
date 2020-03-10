<?php

return [

    /*
     * The mailer used by Mailcoach for password resets and summary emails.
     * Mailcoach will use the default Laravel mailer if this is not set.
     */
    'mailer' => null,

    /*
     * The default mailer used by Mailcoach for campaign sends. This can
     * be overridden on a List level.
     */
    'campaign_mailer' => null,

    /*
     * The default mailer used by Mailcoach for double opt-in and confirmation mails.
     * This can be overridden on a List level.
     */
    'transactional_mailer' => null,

    /*
     * The date format used on all screens of the UI
     */
    'date_format' => 'Y-m-d H:i',

    /*
     * Replacers are classes that can make replacements in the html of a campaign.
     *
     * You can use a replacer to create placeholders.
     */
    'replacers' => [
        \Spatie\Mailcoach\Support\Replacers\WebviewReplacer::class,
        \Spatie\Mailcoach\Support\Replacers\SubscriberReplacer::class,
        \Spatie\Mailcoach\Support\Replacers\EmailListReplacer::class,
        \Spatie\Mailcoach\Support\Replacers\UnsubscribeUrlReplacer::class,
    ],

    /**
     * Here you can configure which template editor Mailcoach uses.
     * By default this is a text editor that highlights HTML.
     */
    'editor' => \Spatie\MailcoachUnlayer\UnlayerEditor::class,

    /*
     * Here you can specify which jobs should run on which queues.
     * Use an empty string to use the default queue.
     */
    'perform_on_queue' => [
        'calculate_statistics_job' => 'mailcoach',
        'send_campaign_job' => 'send-campaign',
        'send_mail_job' => 'send-mail',
        'send_test_mail_job' => 'mailcoach',
        'process_feedback_job' => 'mailcoach-feedback'
    ],

    /*
     * By default only 10 mails per second will be sent to avoid overwhelming your
     * e-mail sending service. To use this feature you must have Redis installed.
     */
    'throttling' => [
        'enabled' => true,
        'redis_connection_name' => 'default',
        'redis_key' => 'laravel-mailcoach',
        'allowed_number_of_jobs_in_timespan' => 10,
        'timespan_in_seconds' => 1,
        'release_in_seconds' => 5,
    ],

    /*
     * You can customize some of the behavior of this package by using our own custom action.
     * Your custom action should always extend the one of the default ones.
     */
    'actions' => [
        /*
         * Actions concerning campaigns
         */
        'calculate_statistics' => \Spatie\Mailcoach\Actions\Campaigns\CalculateStatisticsAction::class,
        'convert_html_to_text' => \Spatie\Mailcoach\Actions\Campaigns\ConvertHtmlToTextAction::class,
        'personalize_html' => \Spatie\Mailcoach\Actions\Campaigns\PersonalizeHtmlAction::class,
        'prepare_email_html' => \Spatie\Mailcoach\Actions\Campaigns\PrepareEmailHtmlAction::class,
        'prepare_webview_html' => \Spatie\Mailcoach\Actions\Campaigns\PrepareWebviewHtmlAction::class,
        'retry_sending_failed_sends' => \Spatie\Mailcoach\Actions\Campaigns\RetrySendingFailedSendsAction::class,
        'send_campaign' => \Spatie\Mailcoach\Actions\Campaigns\SendCampaignAction::class,
        'send_mail' => \Spatie\Mailcoach\Actions\Campaigns\SendMailAction::class,
        'send_test_mail' => \Spatie\Mailcoach\Actions\Campaigns\SendTestMailAction::class,

        /*
         * Actions concerning subscribers
         */
        'confirm_subscriber' => \Spatie\Mailcoach\Actions\Subscribers\ConfirmSubscriberAction::class,
        'create_subscriber' => \Spatie\Mailcoach\Actions\Subscribers\CreateSubscriberAction::class,
        'import_subscribers' => \Spatie\Mailcoach\Actions\Subscribers\ImportSubscribersAction::class,
        'send_confirm_subscriber_mail' => \Spatie\Mailcoach\Actions\Subscribers\SendConfirmSubscriberMailAction::class,
        'send_welcome_mail' => \Spatie\Mailcoach\Actions\Subscribers\SendWelcomeMailAction::class,
        'update_subscriber' => \Spatie\Mailcoach\Actions\Subscribers\UpdateSubscriberAction::class,
    ],

    /*
     * Unauthorized users will get redirected to this route.
     */
    'redirect_unauthorized_users_to_route' => 'login',

    /*
     *  This configuration option defines the authentication guard that will
     *  be used to protect your the Mailcoach UI. This option should match one
     *  of the authentication guards defined in the "auth" config file.
     */
    'guard' => env('MAILCOACH_GUARD', null),

    /*
     *  These middleware will be assigned to every Mailcoach UI route, giving you the chance
     *  to add your own middleware to this stack or override any of the existing middleware.
     */
    'middleware' => [
        'web',
        Spatie\Mailcoach\Http\App\Middleware\Authenticate::class,
        Spatie\Mailcoach\Http\App\Middleware\Authorize::class,
        Spatie\Mailcoach\Http\App\Middleware\SetMailcoachDefaults::class,
    ]
];