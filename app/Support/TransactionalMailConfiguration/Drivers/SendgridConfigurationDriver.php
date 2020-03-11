<?php

namespace App\Support\TransactionalMailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

class SendgridConfigurationDriver extends TransactionalMailConfigurationDriver
{
    public function name(): string
    {
        return 'sendgrid';
    }

    public function validationRules(): array
    {
        return [
            'sendgrid_api_key' => 'required',
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $config->set('mail.mailers.mailcoach-transactional.transport', 'smtp');
        $config->set('mail.mailers.mailcoach-transactional.host', 'smtp.sendgrid.net');
        $config->set('mail.mailers.mailcoach-transactional.username', 'apikey');
        $config->set('mail.mailers.mailcoach-transactional.encryption', null);
        $config->set('mail.mailers.mailcoach-transactional.password', $values['sendgrid_api_key']);
    }
}
