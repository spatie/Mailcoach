<?php

namespace App\Support\TransactionalMailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

class PostmarkConfigurationDriver extends TransactionalMailConfigurationDriver
{
    public function name(): string
    {
        return 'postmark';
    }

    public function validationRules(): array
    {
        return [
            'postmark_token' => 'required',
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $config->set('mail.mailers.mailcoach-transactional.transport', $this->name());
        $config->set('mail.mailers.mailcoach-transactional.token', $values['postmark_token']);
    }
}
