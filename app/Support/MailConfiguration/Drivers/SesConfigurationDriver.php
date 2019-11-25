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
            'key' => 'required',
            'secret' => 'required',
            'region' => 'required',
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $config->set('mail.driver', $this->name());
        $config->set('services.ses', [
            'key' => $values['key'],
            'secret' => $values['secret'],
            'region' => $values['region'],
        ]);
    }
}
