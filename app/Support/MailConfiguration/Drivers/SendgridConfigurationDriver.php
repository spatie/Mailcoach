<?php

namespace App\Support\MailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

class SendgridConfigurationDriver extends MailConfigurationDriver
{
    public function name(): string
    {
        return 'sendgrid';
    }

    public function validationRules(): array
    {
        return [
            'sendgrid_mails_per_second' => 'required|numeric|between:1,100',
            'sendgrid_api_key' => 'required',
            'sendgrid_signing_secret' => 'required',
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $this->throttleNumberOfMailsPerSecond($config, $values['sendgrid_mails_per_second'] ?? 5);

        $config->set('mail.driver', 'smtp');
        $config->set('mail.host', 'smtp.sendgrid.net');
        $config->set('mail.username', 'apikey');
        $config->set('mail.encryption', null);
        $config->set('mail.password', $values['sendgrid_api_key']);

        $config->set('mailcoach.sendgrid_feedback', [
            'signing_secret' => $values['sendgrid_signing_secret'],
        ]);
    }
}
