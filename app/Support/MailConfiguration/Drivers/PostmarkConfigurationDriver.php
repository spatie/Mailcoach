<?php

namespace App\Support\MailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

class PostmarkConfigurationDriver extends MailConfigurationDriver
{
    public function name(): string
    {
        return 'postmark';
    }

    public function validationRules(): array
    {
        return [
            'default_from_mail' => 'required',
            'postmark_mails_per_second' => 'required|numeric|between:1,100',
            'postmark_token' => 'required',
            'postmark_signing_secret' => 'required',
        ];
    }

    public function registerConfigValues(Repository $config, array $values)
    {
        $this
            ->setDefaultFromEmail($config, $values['default_from_mail'] ?? '')
            ->throttleNumberOfMailsPerSecond($config, $values['postmark_mails_per_second'] ?? 5);

        $config->set('mail.driver', $this->name());
        $config->set('services.postmark', [
            'token' => $values['postmark_token'],
        ]);
        $config->set('mailcoach.postmark_feedback', [
            'signing_secret' => $values['postmark_signing_secret'],
        ]);
    }
}
