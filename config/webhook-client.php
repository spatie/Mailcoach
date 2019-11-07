<?php

return [
    'configs' => [
        [
            'name' => 'mailgun',
            'signing_secret' => env('MAILGUN_SIGNING_KEY'),
            'signature_header_name' => 'Signature',
            'signature_validator' => \App\Support\Mailgun\MailgunSignatureValidator::class,
            'webhook_profile' => \Spatie\WebhookClient\WebhookProfile\ProcessEverythingWebhookProfile::class,
            'webhook_model' => \Spatie\WebhookClient\Models\WebhookCall::class,
            'process_webhook_job' => \App\Jobs\ProcessMailgunWebhookJob::class,
        ],
    ],
];
