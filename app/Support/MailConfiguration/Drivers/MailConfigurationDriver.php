<?php

namespace App\Support\MailConfiguration\Drivers;

use Illuminate\Contracts\Config\Repository;

abstract class MailConfigurationDriver
{
    abstract public function name(): string;

    abstract public function validationRules(): array;

    abstract public function registerConfigValues(Repository $config, array $values);

    public function fields()
    {
        return array_keys($this->validationRules());
    }

    protected function throttleNumberOfMailsPerSecond(Repository $config, int $mailsPerSecond): self
    {
        $config->set('mailcoach.throttling.enabled', true);
        $config->set('mailcoach.throttling.allowed_number_of_jobs_in_timespan', $mailsPerSecond);
        $config->set('mailcoach.throttling.timespan_in_seconds', 1);
        $config->set('mailcoach.throttling.release_in_seconds', $mailsPerSecond);

        return $this;
    }

    protected function setDefaultFromEmail(Repository $config, string $defaultFromEmail): self
    {
        $config->set('mail.from.address', $defaultFromEmail);

        return $this;
    }

}
