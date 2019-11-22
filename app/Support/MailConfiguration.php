<?php

namespace App\Support;

use Illuminate\Config\Repository;
use Spatie\Valuestore\Valuestore;

class MailConfiguration
{
    /** @var \Spatie\Valuestore\Valuestore  */
    protected $valuestore;

    /**@var \Illuminate\Config\Repository */
    protected $config;

    public function __construct(Valuestore $valuestore, Repository $config)
    {
        $this->valuestore = $valuestore;
        $this->config = $config;
    }

    public function put(array $values)
    {
        return $this->valuestore->put($values);
    }

    public function all()
    {
        return $this->valuestore->all();
    }

    public function __get(string $property)
    {
        return $this->valuestore->get($property);
    }

    public function register()
    {
        $this->config->set('mail.driver', 'smtp');
        $this->config->set('mail.host', $this->valuestore->get('mail_host'));
        $this->config->set('mail.port', $this->valuestore->get('mail_port'));
        $this->config->set('mail.encryption', $this->valuestore->get('mail_encryption'));
        $this->config->set('mail.username', $this->valuestore->get('mail_username'));
        $this->config->set('mail.password', $this->valuestore->get('mail_password'));
    }

    public function isValid(): bool
    {
        return false;
    }
}
