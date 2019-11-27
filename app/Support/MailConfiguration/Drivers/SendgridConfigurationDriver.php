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
            'sendgrid_api_key' => 'required',
            'sendgrid_signing_secret' => 'required',
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $config->set('mail.driver', 'smtp');
        $config->set('mail.host', 'smtp.sendgrid.net');
        $config->set('mail.username', 'apikey');
        $config->set('mail.encryption', null);
        $config->set('mail.password', $values['sendgrid_password']);

        $config->set('mailcoach.sendgrid_feedback', [
            'signing_secret' => $values['sendgrid_signing_secret'],
        ]);
    }
}
