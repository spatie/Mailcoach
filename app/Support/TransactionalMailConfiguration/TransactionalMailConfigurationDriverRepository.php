<?php

namespace App\Support\TransactionalMailConfiguration;

use App\Support\TransactionalMailConfiguration\Drivers\TransactionalMailConfigurationDriver;
use App\Support\TransactionalMailConfiguration\Drivers\MailgunConfigurationDriver;
use App\Support\TransactionalMailConfiguration\Drivers\PostmarkConfigurationDriver;
use App\Support\TransactionalMailConfiguration\Drivers\SendgridConfigurationDriver;
use App\Support\TransactionalMailConfiguration\Drivers\SesConfigurationDriver;
use App\Support\TransactionalMailConfiguration\Drivers\SmtpConfigurationDriver;

class TransactionalMailConfigurationDriverRepository
{
    protected array $drivers = [
        'ses' => SesConfigurationDriver::class,
        'mailgun' => MailgunConfigurationDriver::class,
        'sendgrid' => SendgridConfigurationDriver::class,
        'postmark' => PostmarkConfigurationDriver::class,
        'smtp' => SmtpConfigurationDriver::class,
    ];

    public function getSupportedDrivers(): array
    {
        return array_keys($this->drivers);
    }

    public function getForDriver(string $driverName): ?TransactionalMailConfigurationDriver
    {
        return collect($this->drivers)
            ->map(fn (string $driverClass) => app($driverClass))
            ->first(fn (TransactionalMailConfigurationDriver $driver) => $driver->name() === $driverName);
    }
}
