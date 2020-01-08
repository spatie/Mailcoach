<?php

namespace App\Support\MailConfiguration;

use App\Support\MailConfiguration\Drivers\MailConfigurationDriver;
use App\Support\MailConfiguration\Drivers\MailgunConfigurationDriver;
use App\Support\MailConfiguration\Drivers\SendgridConfigurationDriver;
use App\Support\MailConfiguration\Drivers\SesConfigurationDriver;
use App\Support\MailConfiguration\Drivers\SmtpConfigurationDriver;

class MailConfigurationDriverRepository
{
    protected array $drivers = [
        'ses' => SesConfigurationDriver::class,
        'mailgun' => MailgunConfigurationDriver::class,
        'sendgrid' => SendgridConfigurationDriver::class,
        'smtp' => SmtpConfigurationDriver::class,
    ];

    public function getSupportedDrivers(): array
    {
        return array_keys($this->drivers);
    }

    public function getForDriver(string $driverName): ?MailConfigurationDriver
    {
        return collect($this->drivers)
            ->map(fn (string $driverClass) => app($driverClass))
            ->first(fn (MailConfigurationDriver $driver) => $driver->name() === $driverName);
    }
}
