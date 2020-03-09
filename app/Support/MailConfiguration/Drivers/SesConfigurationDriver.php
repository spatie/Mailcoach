<?php

namespace App\Support\MailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

class SesConfigurationDriver extends MailConfigurationDriver
{
    public function name(): string
    {
        return 'ses';
    }

    public function validationRules(): array
    {
        return [
            'default_from_mail' => 'required|email',
            'ses_mails_per_second' => 'required',
            'ses_key' => 'required',
            'ses_secret' => 'required',
            'ses_region' => 'required',
            'ses_configuration_set' => 'required',
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $this
            ->setDefaultFromEmail($config, $values['default_from_mail'] ?? '')
            ->throttleNumberOfMailsPerSecond($config, $values['ses_mails_per_second'] ?? 5);

        $config->set('mail.mailers.mailcoach.transport', $this->name());
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
