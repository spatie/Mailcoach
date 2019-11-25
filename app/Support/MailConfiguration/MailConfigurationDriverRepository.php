<?php

namespace App\Support\MailConfiguration;

use App\Support\MailConfiguration\Drivers\Driver;
use App\Support\MailConfiguration\Drivers\Mailgun;
use App\Support\MailConfiguration\Drivers\Ses;
use App\Support\MailConfiguration\Drivers\Smtp;

class MailConfigurationDriverRepository
{
    protected $drivers = [
        'mailgun' => Mailgun::class,
        'ses' => Ses::class,
        'smtp' => Smtp::class,
    ];

    public function getSupportedDrivers(): array
    {
        return array_keys($this->drivers);
    }

    public function getForDriver(string $driverName): ?Driver
    {
        return collect($this->drivers)
            ->map(function (string $driverClass) {
                return app($driverClass);
            })
            ->first(function (Driver $driver) use ($driverName) {
                return $driver->name() === $driverName;
            });
    }
}
