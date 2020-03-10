<?php

namespace App\Support\TransactionalMailConfiguration;

use App\Support\MailConfiguration\Drivers\MailConfigurationDriver;
use Illuminate\Config\Repository;
use Illuminate\Filesystem\Filesystem;
use Spatie\Valuestore\Valuestore;

class TransactionalMailConfiguration
{
    protected Valuestore $valuestore;

    protected Repository $config;

    protected TransactionalMailConfigurationDriverRepository $transactionalMailConfigurationDriverRepository;

    public function __construct(
        Valuestore $valuestore,
        Repository $config,
        TransactionalMailConfigurationDriverRepository $mailConfigurationDriverRepository
    ) {
        $this->valuestore = $valuestore;
        $this->config = $config;
        $this->transactionalMailConfigurationDriverRepository = $mailConfigurationDriverRepository;
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

        $this->clearCachedConfig();
    }

    public function isValid(): bool
    {
        return $this->getDriver() !== null;
    }

    protected function getDriver() : ?TransactionalMailConfiguration
    {
        return $this
            ->transactionalMailConfigurationDriverRepository
            ->getForDriver($this->valuestore->get('driver', ''));
    }

    protected function clearCachedConfig(): void
    {
        /** @var \Illuminate\Filesystem\Filesystem $filesystem */
        $filesystem = app(Filesystem::class);

        $cacheConfigPath = app()->getCachedConfigPath();

        if (file_exists($cacheConfigPath)) {
            $filesystem->delete($cacheConfigPath);
        }
    }
}
