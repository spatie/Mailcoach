<?php

namespace App\Support\MailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

class Smtp extends Driver
{
    public function name(): string
    {
        return 'smtp';
    }

    public function validationRules(): array
    {
        return [
            'host' => 'required',
            'port' => 'required',
            'username' => 'required',
            'password' => 'required',
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $config->set('mail.driver', $this->name());
        $config->set('mail.host', $values['host']);
        $config->set('mail.username', $values['username']);
        $config->set('mail.password', $values['password']);
    }
}
