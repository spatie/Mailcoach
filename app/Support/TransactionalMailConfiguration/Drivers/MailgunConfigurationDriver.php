<?php

namespace App\Support\TransactionalMailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

class MailgunConfigurationDriver extends TransactionalMailConfigurationDriver
{
    public function name(): string
    {
        return 'mailgun';
    }

    public function validationRules(): array
    {
        return [
            'mailgun_domain' => 'required',
            'mailgun_secret' => 'required',
            'mailgun_endpoint' => 'required',
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $config->set('mail.mailers.mailcoach-transactional.transport', $this->name());
        $config->set('mail.mailers.mailcoach-transactional.domain', $values['mailgun_domain']);
        $config->set('mail.mailers.mailcoach-transactional.secret', $values['mailgun_secret']);
        $config->set('mail.mailers.mailcoach-transactional.endpoint', $values['mailgun_endpoint']);
    }
}
