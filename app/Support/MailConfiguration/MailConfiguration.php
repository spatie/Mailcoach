<?php

namespace App\Support\MailConfiguration;

use App\Support\MailConfiguration\Drivers\Driver;
use Illuminate\Config\Repository;
use Spatie\Valuestore\Valuestore;

class MailConfiguration
{
    /** @var \Spatie\Valuestore\Valuestore  */
    protected $valuestore;

    /**@var \Illuminate\Config\Repository */
    protected $config;

    /** @var \App\Support\MailConfiguration\MailConfigurationDriverRepository */
    protected $mailConfigurationDriverRepository;

    public function __construct(Valuestore $valuestore, Repository $config, MailConfigurationDriverRepository $mailConfigurationDriverRepository)
    {
        $this->valuestore = $valuestore;
        $this->config = $config;
        $this->mailConfigurationDriverRepository = $mailConfigurationDriverRepository;
    }

    public function put(array $values)
    {
        $this->valuestore->flush();

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

    public function registerConfigValues()
    {
        if (!  $this->getDriver()) {
            return;
        }

        $this->getDriver()->registerConfigValues(
            $this->config,
            $this->valuestore->all()
        );
    }

    public function isValid(): bool
    {
        return $this->getDriver() !== null;
    }

    protected function getDriver() : ?Driver
    {
        return $this->mailConfigurationDriverRepository->getForDriver($this->valuestore->get('driver', ''));
    }
}
