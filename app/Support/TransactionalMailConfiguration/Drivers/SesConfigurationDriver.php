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
        $config->set('services.ses', [
            'key' => $values['ses_key'],
            'secret' => $values['ses_secret'],
            'region' => $values['ses_region'],
        ]);
        $config->set('mailcoach.ses_feedback', [
            'configuration_set' => $values['ses_configuration_set']
        ]);
    }
}
