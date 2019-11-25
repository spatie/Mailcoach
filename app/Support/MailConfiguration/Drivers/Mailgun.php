<?php

namespace App\Support\MailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

class Mailgun extends Driver
{
    public function name(): string
    {
        return 'mailgun';
    }

    public function validationRules(): array
    {
        return [
            'domain' => 'required',
            'secret' => 'required',
            'endpoint' => 'required',
            'signing_secret' => 'required',
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $config->set('mail.driver', $this->name());
        $config->set('services.mailgun', [
            'domain' => $values['domain'],
            'secret' => $values['secret'],
            'endpoint' => $values['endpoint'],
        ]);
        $config->set('mailcoach.mailgun_feedback', [
            'signing_secret' => $values['signing_secret'],
        ]);
    }
}
