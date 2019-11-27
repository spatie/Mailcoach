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
            'sendgrid_host' => 'required',
            'sendgrid_port' => 'required',
            'sendgrid_username' => 'required',
            'sendgrid_password' => 'required',
            'sendgrid_signing_secret' => 'required',

        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $config->set('mail.driver', 'smtp');
        $config->set('mail.host', $values['sendgrid_host']);
        $config->set('mail.port', $values['sendgrid_port']);
        $config->set('mail.username', $values['sendgrid_username']);
        $config->set('mail.password', $values['sendgrid_password']);

        $config->set('mailcoach.sendgrid_feedback', [
            'signing_secret' => $values['sendgrid_signing_secret'],
        ]);
    }
}
