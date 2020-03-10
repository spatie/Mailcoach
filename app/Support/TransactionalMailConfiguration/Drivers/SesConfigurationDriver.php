<?php

namespace App\Support\TransactionalMailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

class SesConfigurationDriver extends TransactionalMailConfigurationDriver
{
    public function name(): string
    {
        return 'ses';
    }

    public function validationRules(): array
    {
        return [
            'ses_key' => 'required',
            'ses_secret' => 'required',
            'ses_region' => 'required',
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $config->set('mail.mailers.mailcoach-transactional.transport', $this->name());
        $config->set('mail.mailers.mailcoach-transactional.key', $values['ses_key']);
        $config->set('mail.mailers.mailcoach-transactional.secret', $values['ses_secret']);
        $config->set('mail.mailers.mailcoach-transactional.region', $values['ses_region']);
    }
}
