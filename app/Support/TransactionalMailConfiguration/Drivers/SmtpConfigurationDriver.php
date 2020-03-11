<?php

namespace App\Support\TransactionalMailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

class SmtpConfigurationDriver extends TransactionalMailConfigurationDriver
{
    public function name(): string
    {
        return 'smtp';
    }

    public function validationRules(): array
    {
        return [
            'smtp_host' => 'required',
            'smtp_port' => 'required',
            'smtp_username' => 'required',
            'smtp_password' => 'required',
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $config->set('mail.mailers.mailcoach-transactional.transport', $this->name());
        $config->set('mail.mailers.mailcoach-transactional.host', $values['smtp_host']);
        $config->set('mail.mailers.mailcoach-transactional.port', $values['smtp_port']);
        $config->set('mail.mailers.mailcoach-transactional.username', $values['smtp_username']);
        $config->set('mail.mailers.mailcoach-transactional.password', $values['smtp_password']);
    }
}
